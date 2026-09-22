<template>
    <div class="flex flex-col sm:flex-row sm:items-end gap-4">
        <!-- Component <select> for list of processes availables -->
        <div class="flex-1">
            <jet-label value="Proceso" />
            <form-select :value="processLabel" :list="listProcesses" :disabled="verifiedProcess < 2"
                         @value="processSelected"></form-select>
        </div>

        <!-- Native <input type="date"> for date end of the process -->
        <div class="flex-1">
            <jet-label for="completionDate" value="Fecha tentativa terminación" />
            <jet-input id="completionDate" type="date" class="mt-1 block w-full" v-model="completionDate"
                       :min="minDate" :max="maxDate" :disabled="verifiedProcess === 0" />
        </div>

        <!-- Buttons for manage (as add or reset fields) of the current process -->
        <div class="flex gap-2">
            <button v-for="(action, i) in actions" :key="i" type="button"
                    :title="action.messageTooltip" :disabled="action.disabled"
                    @click="action.eventName"
                    class="p-2 rounded-full text-white bg-primary hover:opacity-90 disabled:opacity-30 disabled:cursor-not-allowed">
                <svg v-if="action.icon === 'add'" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </button>
        </div>

        <!-- Message of alert in case present any problem -->
        <jet-dialog-modal :show="dialogProcess" @close="resetAll">
            <template #title> ¡Oops! </template>
            <template #content> Se ha perdido la continuidad para configurar las fechas tentativas de los procesos. Deberá empezar de nuevo. </template>
            <template #footer>
                <jet-button @click="resetAll"> Lo arreglaré </jet-button>
            </template>
        </jet-dialog-modal>
    </div>
</template>

<script>
import FormSelect from "@/Components/Forms/Select";
import JetLabel from "@/Jetstream/Label";
import JetInput from "@/Jetstream/Input";
import JetButton from "@/Jetstream/Button";
import JetDialogModal from "@/Jetstream/DialogModal";

export default {
    name: "AddProcess",

    components: {
        FormSelect,
        JetLabel,
        JetInput,
        JetButton,
        JetDialogModal,
    },

    props: {
        listProcesses: {
            type: Array,
            default: () => []
        },
    },

    created() {
        // Sets the variables that the date input use for show days availables
        this.minDate = new Date().toISOString().substring(0, 10)
        this.maxDate = new Date(new Date().setMonth(new Date().getMonth() + 1)).toISOString().substring(0, 10)
        // Sets the auxiliar variable that will use a question before add a process
        this.beforeSequenceProcess = 0
    },

    data() {
        return {
            idProcess: '',
            processLabel: 'Elige un proceso',
            completionDate: '',
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
        processSelected(value) {
            this.idProcess = value.id
            this.processLabel = value.name
        },

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
            this.processLabel = 'Elige un proceso'
            this.completionDate = ''
            this.verifiedProcess = 2
        },

        resetAll() {
            this.minDate = new Date().toISOString().substring(0, 10)
            this.maxDate = new Date(new Date().setMonth(new Date().getMonth() + 1)).toISOString().substring(0, 10)
            this.beforeSequenceProcess = 0
            this.beforeCompletionDate = ''
            this.resetProcess()
            this.dialogProcess = false
            this.$emit('resetAll')
        },

        // Function that return a object with the info of the current process as your description and the sequence
        process(idProcess) {
            for (const listProcess of this.listProcesses) {
                if (listProcess.id === idProcess) {
                    return {name: listProcess.name, sequence: listProcess.sequence}
                }
            }
        }
    },

    computed: {
        actions() {
            return [
                {
                    eventName: this.addProcess,
                    disabled: !(this.verifiedProcess <= 0),
                    icon: 'add',
                    messageTooltip: 'Añadir a procesos'
                },
                {
                    eventName: this.resetProcess,
                    disabled: this.verifiedProcess >= 2,
                    icon: 'reset',
                    messageTooltip: 'Limpiar campos'
                },
            ]
        }
    },
}
</script>
