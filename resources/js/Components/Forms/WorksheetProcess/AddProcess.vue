<template>
    <v-row justify="space-between">
        <!-- Component <select> for list of processes availables -->
        <v-col cols="12" xs="12" sm="4" md="4" lg="5" class="py-0">
            <v-select
                    :items="listProcesses"
                    label="Proceso"
                    :item-value="listProcesses.idProcess"
                    v-model="idProcess"
                    outlined dense
                    :readonly="verifiedProcess < 2"
                    prepend-icon="mdi-layers">
            </v-select>
        </v-col>
        <!-- Component <date-picker> for set date end of the process -->
        <v-col cols="12" xs="12" sm="4" md="4" lg="5" class="py-0">
            <v-dialog v-model="showDialogCompletionDate" :return-value="completionDate" persisten width="300px">
                <template v-slot:activator="{on, attrs}">
                    <v-text-field
                            :value="completionDateFormatted"
                            v-bind="attrs"
                            v-on="on"
                            label="Fecha tentativa terminación"
                            prepend-icon="mdi-calendar"
                            outlined dense></v-text-field>
                </template>
                <v-date-picker
                        v-model="completionDate"
                        @input="showDialogCompletionDate = false"
                        :picker-date="completionDate"
                        :min="minDate"
                        :max="maxDate"
                        :disabled="verifiedProcess === 0"
                        scrollable>
                </v-date-picker>
            </v-dialog>
        </v-col>
        <!-- Buttons for manage (as add or reset fields) of the current process -->
        <v-col lg="2" class="d-flex inline-flex justify-space-around py-0">
            <v-tooltip v-for="(action, i) in actions" :key="i" bottom>
                <template v-slot:activator="{ on, attrs}">
                    <v-btn
                            v-bind="attrs" v-on="on"
                            :disabled="action.disabled" @click="action.eventName"
                            elevation="2"
                            :color="action.color"
                            small fab class="mr-2">
                        <v-icon>{{ action.icon }}</v-icon>
                    </v-btn>
                </template>
                <span> {{ action.messageTooltip }}</span>
            </v-tooltip>
        </v-col>
        <!-- Message of alert in case present any problem -->
        <v-dialog v-model="dialogProcess" persistent max-width="450">
            <v-card>
                <v-card-title class="headline"> ¡Oops! </v-card-title>
                <v-card-text> Se ha perdido la continuidad para configurar las fechas tentativas de los procesos. Deberá empezar de nuevo.</v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary darken-1" text @click="resetAll"> Lo arreglaré </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-row>
</template>

<script>
import moment from 'moment';

export default {
    name: "AddProcess",

    props: {
        listProcesses: {
            type: Array,
            default: []
        },
    },

    created() {
        // Sets the variables that the <date-picker> component use for show days availables
        this.minDate = new Date().toISOString()
        this.maxDate = new Date(new Date().setMonth(new Date().getMonth() + 1)).toISOString()
        // Sets the auxiliar variable that will use a question before add a process
        this.beforeSequenceProcess = 0
    },

    data() {
        return {
            idProcess: '',
            completionDate: '',
            showDialogCompletionDate: false,
            dialogProcess: false,
            // This variable will store the number of remaining fields required to add a process. If your value is reduce to zero, then the process will save
            verifiedProcess: 2,
            // Max date for set a date final to end the process or task
            maxDate: '',
            // Each time that a process added, the minDate variable will sets with the value of the completionDate variable of the current process
            minDate: '',
            // Auxiliars variables for ask before add a process
            beforeCompletionDate: '',
            beforeSequenceProcess: ''
        }
    },

    watch: {
        // If the value of idProcess change, then the verifiedProcess variable will reduce your value one time
        idProcess(newValue, oldValue) {
            return newValue !== '' ? this.verifiedProcess-- : this.verifiedProcess
        },
        // If the value of completionDate change, the the verifiedProcess variable will reduce your value one time
        completionDate(newValue, oldValue) {
            return newValue !== '' ? this.verifiedProcess-- : this.verifiedProcess
        }
    },

    methods: {
        // This function will says to your container element that this info of the process with idProcess and the completionDate are been setted
        addProcess() {
            // All process have a order of urgency for execute. Here we get the secuence of the process
            let currentSequenceProcess = this.process(this.idProcess).sequence
            // Finally we use the VerifiedProcess variable to ask if the counter is less than or equal to zero
            if (this.verifiedProcess <= 0) {
                if (currentSequenceProcess > this.beforeSequenceProcess && this.completionDate >= this.beforeCompletionDate) {
                    // Object wit the info of the current process
                    let process = {
                        id_process: this.idProcess,
                        completion_date: this.completionDate,
                        process: this.process(this.idProcess),
                    }
                    this.beforeCompletionDate, this.minDate = this.completionDate
                    this.beforeSequenceProcess = currentSequenceProcess
                    this.resetProcess()
                    // We send the info to our container element
                    this.$emit('addProcess', process);
                } else {
                    // Show a dialog for explain to user that the process not is in your correctly order
                    this.dialogProcess = true
                }
            }
        },

        resetProcess() {
            this.idProcess = ''
            this.completionDate = ''
            this.verifiedProcess = 2
        },

        resetAll() {
            this.minDate = new Date().toISOString()
            this.maxDate = new Date(new Date().setMonth(new Date().getMonth() + 1)).toISOString()
            this.beforeSequenceProcess = 0
            this.beforeCompletionDate = ''
            this.resetProcess()
            this.dialogProcess = false
            this.$emit('resetAll')
        },

        // Function that return a object with the info of the current process as your description and the sequence
        process(idProcess) {
            for (const listProcess of this.listProcesses) {
                if (listProcess.value === idProcess) {
                    return {name: listProcess.text, sequence: listProcess.sequence}
                }
            }
        }
    },

    computed: {
        completionDateFormatted() {
            return this.completionDate ? moment(this.completionDate).format('dddd, D MMMM, YYYY') : '';
        },

        actions() {
            return [
                {
                    eventName: this.addProcess,
                    disabled: !this.verifiedProcess <= 0,
                    color: 'primary',
                    icon: 'mdi-plus',
                    messageTooltip: 'Añadir a procesos'
                },
                {
                    eventName: this.resetProcess,
                    disabled: this.verifiedProcess >= 2,
                    color: 'primary',
                    icon: 'mdi-eraser-variant',
                    messageTooltip: 'Limpiar campos'
                },
            ]
        }
    },
}
</script>
