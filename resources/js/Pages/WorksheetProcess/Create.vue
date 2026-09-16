<template>
    <worksheet-layout>
        <template #toolbarTitle> Hoja de trabajo </template>
        <template #main>
            <v-container>
                <v-form ref="formWorksheetProcesses">
                    <v-row>
                        <v-col cols="12">
                            <h2> Establecer fechas tentativas </h2>
                            <p v-if="worksheet.id"> Los procesos que aplican para el período <strong> {{
                                    worksheet.period
                                }} </strong> del cliente <strong> {{ worksheet.customer.name }} </strong> se listan a continuación. Cada uno de los procesos requieren una fecha en la que se espera cumplir con las tareas designadas. </p>
                            <p v-else> Selecciona una hoja de trabajo en el período que necesite de la empresa que desee configurar las fechas para la terminación de cada uno de los procesos. </p>
                        </v-col>
                    </v-row>
                    <v-row v-if="!worksheet.id">
                        <v-col xs="12" sm="4" class="py-0">
                            <v-select label="Cliente" outlined dense
                                      v-model="form.worksheet.customer.id"
                                      :loading="listCustomers.length === 0"
                                      :items="listCustomers"
                                      :readonly="showAddProcess"
                                      prepend-icon="mdi-factory"></v-select>
                        </v-col>
                        <v-col xs="12" sm="4" md="3" lg="2" class="py-0">
                            <v-select label="Período" outlined dense
                                      v-model="form.worksheet.period.id_worksheet"
                                      :loading="listPeriods.length === 0 && form.worksheet.customer.id !== ''"
                                      :items="listPeriods"
                                      :readonly="!form.worksheet.customer.id || showAddProcess"
                                      prepend-icon="mdi-timeline"></v-select>
                        </v-col>
                    </v-row>
                    <add-process v-if="showAddProcess" :list-processes="listProcesses"
                                 @addProcess="addProcess" @resetAll="deleteFormProcesses"></add-process>
                    <v-row>
                        <v-col>
                            <v-data-table :headers="headerProcessesDatatable" :items="form.processes"
                                          :sort-by="['process.sequence']" color="primary"
                                          calculate-widths dense hide-default-footer
                                          locale="es">
                                <template #no-data> No se han encontrado procesos aplicados a este cliente </template>
                                <template #item.id_process="{item}">
                                    {{ item.process.name }}
                                </template>
                                <template #item.completion_date="{item}">
                                    {{ completionDateFormatted(item) }}
                                </template>
                                <template #item.actions="{item}">
                                    <v-icon class="mr-2" @click="editProcess(item)"> mdi-pencil </v-icon>
                                    <v-icon class="mr-2" @click="deleteProcess(item)"> mdi-delete </v-icon>
                                </template>
                            </v-data-table>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col>
                            <v-btn outlined color="primary" @click="confirmingCreateWorksheetProcess = true"
                                   :disabled="!form.processes.length > 0"
                                   class="mt-5"> Relacionar a Hoja de trabajo </v-btn>
                        </v-col>
                    </v-row>
                </v-form>
                <v-dialog v-model="confirmingCreateWorksheetProcess" max-width="500">
                    <v-card>
                        <v-card-title class="headline"> Confirmar creación </v-card-title>
                        <v-card-text>
                            <p> ¿Está seguro de relacionar los procesos seleccionados a la Hoja de trabajo para el período
                                <strong> {{ form.worksheet.period.date }} </strong>
                                para el cliente <strong> {{ form.worksheet.customer.name }}</strong>?</p>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="grey darken-1" text @click="confirmingCreateWorksheetProcess = false"> No, cancelar</v-btn>
                            <v-btn color="primary darken-1" text @click="createWorksheetProcess"> Sí, proceder</v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
                <v-dialog v-model="form.hasErrors" max-width="700" persistent>
                    <v-card>
                        <v-card-title class="headline"> Se presentó un problema </v-card-title>
                        <v-card-text>
                            <p> Alguno de los datos suministrados presenta inconsistencias o el servidor no se encuentra disponible para procesar la solicitud actual </p>
                            <h4 class="mb-1">Se encontraron los siguientes errores:</h4>
                            <ul>
                                <li v-for="(error, i) in errorsFoundOnCreate" :key="i">
                                    <span class="red--text text--lighten-2">{{ error }}</span>
                                </li>
                            </ul>

                            <p class="mt-4"><strong> Consulta con el administrador del sistema </strong></p>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="grey darken-1" text @click="confirmingReadErrors"> Ok </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
                <v-progress-circular v-if="showProgressCircular" indeterminate color="primary"></v-progress-circular>
            </v-container>
        </template>
    </worksheet-layout>

</template>




<script>
import WorksheetLayout from "@/Layouts/WorksheetLayout";
import AddProcess from "@/Components/Forms/WorksheetProcess/AddProcess";
import moment from 'moment'

moment.locale('es')

export default {
    name: "CreateWorksheetProcessForm",

    components: {
        WorksheetLayout,
        AddProcess
    },

    props: {
        worksheet: {
            type: Object,
            required: false,
            default: {}
        },
    },

    beforeMount() {
        // Querying the database for all worksheets whose periods have not yet closed
        this.openedWorksheets()

        // If when entering this form, the request brings parameters, then
        if (this.worksheet.id) {
            this.form.worksheet.customer.id = this.worksheet.customer.id
            this.form.worksheet.customer.name = this.worksheet.customer.name
            this.form.worksheet.period.id_worksheet = this.worksheet.id
            this.form.worksheet.period.date = this.worksheet.period
        }
    },

    data() {
        return {
            // Object that will store the info to send and save to the server
            form: this.$inertia.form({
                // Required worksheet information
                worksheet: {
                    // Info of the customer
                    customer: {
                        id: '',
                        name: ''
                    },
                    // Info of the worksheet
                    period: {
                        id_worksheet: '',
                        date: ''
                    }
                },
                // Repository for the processes to be related to the worksheet
                processes: []
            }),
            headerProcessesDatatable: [
                {text: 'Secuencia', align: 'center', sortable: true, value: 'process.sequence'},
                {text: 'Proceso', align: 'start', sortable: false, value: 'id_process'},
                {text: 'Fecha tentativa finalización', align: 'start', sortable: false, value: 'completion_date'},
                {text: 'Acciones', align: 'center', sortable: false, value: 'actions'}
            ],
            // Auxiliary variable to save drop-down lists of customers and periods
            worksheets: {
                customers: [],
                periods: []
            },
            confirmingCreateWorksheetProcess: false,
            errorsFoundOnCreate: [],
            showProgressCircular: false,
        }
    },

    methods: {
        // Request for currently open worksheets with respective clients
        openedWorksheets() {
            axios.get('/api/worksheet/opened').then((response) => {
                let worksheets = _.toArray(_.groupBy(response.data, (element) => {
                    return element.customer.id
                }))
                // Obtaining the values of the response as a array
                // let values = Object.values(response.data)
                // Accessing each of the received values
                // First step: doing a list of customers with worksheets periods opened
                for (const worksheet of worksheets) {
                    // console.log(customer)
                    let customer = worksheet[0].customer
                    // Adding the current customer to the list
                    this.worksheets.customers.push({id: customer.id, name: customer.info.thirdName})

                    // Second step: make a list of the periods of each of the clients received
                    worksheet.forEach((period) => {
                        // Adding each period to the list
                        this.worksheets.periods.push({
                            idCustomer: period.customer.id,
                            idWorksheet: period.id,
                            period: period.period
                        })
                    })
                }
            }).catch((error) => {
                this.worksheets = error
            })
        },

        // Function that adds the process passed to the array of the object form.processes
        addProcess(process) {
            // Remove processes to avoid duplicates
            this.removeProcessFromListProcesses(process)
            // Add new process to the form
            this.form.processes.push(process)
        },

        removeProcessFromListProcesses(process) {
            this.listProcesses = this.worksheet.processes.filter((value, index, arr) => {
                return value.id_process !== process.id_process ? value : arr.splice(index, 1)
            })
        },

        editProcess(item) {
            return 0
        },

        deleteProcess(process) {
            let processIndex = this.form.processes.indexOf(process)
            // Add the current process to the list of processes setteable
            this.addProcessToListProcesses(process)
            // Finally, drop the process from the list
            this.form.processes.splice(processIndex, 1)
        },

        addProcessToListProcesses(process) {
            this.worksheet.processes.push(
                {
                    id_process: process.id_process,
                    name: process.process.name,
                    sequence: process.process.sequence
                }
            )
        },

        completionDateFormatted(item) {
            return moment(item.completion_date).format('dddd, D MMMM, YYYY')
        },

        deleteFormProcesses() {
            for (const process of this.form.processes) {
                this.deleteProcess(process)
            }
        },

        getCustomerFromList(id) {
            return _.find(this.listCustomers, (element) => {
                return element.value === id ? element.text : ''
            })
        },

        getPeriodFromList(id) {
            return _.find(this.listPeriods, (element) => {
                return element.value === id ? element.text : ''
            })
        },

        createWorksheetProcess() {
            this.showProgressCircular = true
            this.form.transform((data) => ({
                id_customer: data.worksheet.customer.id,
                id_worksheet: data.worksheet.period.id_worksheet,
                creator_user: this.$page.props.user.id,
                processes: data.processes
            })).post(route('worksheet.processes.new'), {
                errorBag: 'createWorksheetProcess',
                onSuccess: () => {
                    this.showProgressCircular = false
                }
            });
        },

        confirmingReadErrors() {
            this.form.clearErrors()
            this.errorsFoundOnCreate = []
        }
    },

    computed: {
        // Function that return an array with the processes data received from the server and ready for read
        listProcesses: {
            set: function (newValue) {
                return this.worksheet.proccess = newValue;
            },
            get: function () {
                let listProcesses = [];
                for (const process of this.worksheet.processes) {
                    listProcesses.push({text: process.name, value: process.id_process, sequence: process.sequence})
                }
                return _.sortBy(listProcesses, ['sequence'])
            }
        },

        listCustomers: {
            set: function (newValue) {
                return this.worksheets.customers = newValue
            },

            get: function () {
                let listCustomers = []
                for (const customer of this.worksheets.customers) {
                    listCustomers.push({text: customer.name, value: customer.id})
                }
                return listCustomers
            }
        },

        listPeriods: {
            set: function (newValue) {
                return this.worksheets.periods = newValue
            },

            get: function () {
                let listPeriods = []
                if (this.form.worksheet.customer.id !== '') {
                    this.worksheets.periods.filter((key, index, arr) => {
                        if (key.idCustomer === this.form.worksheet.customer.id) {
                            listPeriods.push({text: key.period, value: key.idWorksheet})
                        }
                    });
                }
                return listPeriods
            }
        },

        listErrors() {
            // set: function (newValue) {
            //     return this.errorsFoundOnCreate = newValue
            // },
            //
            // get: function () {
            //     let listErrors = []
            //     if (this.errorsFoundOnCreate) {
            //
            //     }
            // }
            if (this.errorsFoundOnCreate) {

            }
        },

        showAddProcess() {
            return this.listProcesses.length > 0 && this.form.worksheet.customer.id !== '' && this.form.worksheet.period.id_worksheet !== ''
        }
    },

    watch: {
        'form.worksheet.customer.id'(newValue, oldValue) {
            this.form.worksheet.period.date = ''
            this.form.worksheet.customer.name = this.getCustomerFromList(newValue).text
        },

        'form.worksheet.period.id_worksheet'(newValue, oldValue) {
            this.form.worksheet.period.date = this.getPeriodFromList(newValue).text
            axios.get('/api/worksheet/' + this.form.worksheet.customer.id + '/' + this.form.worksheet.period.date)
                .then((response) => {
                    console.log(response.data)
                    let worksheet = response.data
                    worksheet.worksheetProcesses.forEach((worksheetProcess) => {
                        let process = {
                            completion_date: worksheetProcess.idealCompletionDate,
                            id_process: worksheetProcess.process.id,
                            process: {
                                name: worksheetProcess.process.name, sequence:
                                worksheetProcess.process.sequence
                            }
                        }
                        this.form.processes.push(process)
                        this.removeProcessFromListProcesses(process)
                    })
                })
                .catch((error) => {
                    console.log(error)
                })
        },

        'form.errors'(newValue, oldValue) {
            this.confirmingCreateWorksheetProcess = false
            // this.errorsFoundOnCreate = _.toPairs(this.form.errors)
            let errors = Object.values(this.form.errors)
            errors.forEach((element) => {
                this.errorsFoundOnCreate.push(element)
            })
        }
    },
};
</script>
