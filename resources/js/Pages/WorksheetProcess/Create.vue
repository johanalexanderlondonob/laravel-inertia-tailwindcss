<template>
    <worksheet-layout>
        <template #toolbarTitle> Hoja de trabajo </template>
        <template #main>
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800"> Establecer fechas tentativas </h2>
                <p v-if="worksheet.id" class="mt-1 text-sm text-gray-500">
                    Los procesos que aplican para el período <strong>{{ worksheet.period }}</strong>
                    del cliente <strong>{{ worksheet.customer.name }}</strong> se listan a continuación.
                    Cada uno de los procesos requieren una fecha en la que se espera cumplir con las tareas designadas.
                </p>
                <p v-else class="mt-1 text-sm text-gray-500">
                    Selecciona una hoja de trabajo en el período que necesite de la empresa que desee configurar las fechas para la terminación de cada uno de los procesos.
                </p>

                <div v-if="!worksheet.id" class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-4 max-w-xl">
                    <div>
                        <jet-label value="Cliente" />
                        <form-select :value="customerLabel" :list="listCustomers" :disabled="showAddProcess"
                                     @value="customerSelected"></form-select>
                    </div>
                    <div>
                        <jet-label value="Período" />
                        <form-select :value="periodLabel" :list="listPeriods"
                                     :disabled="!form.worksheet.customer.id || showAddProcess"
                                     @value="periodSelected"></form-select>
                    </div>
                </div>

                <div class="mt-6" v-if="showAddProcess">
                    <add-process :list-processes="listProcesses"
                                 @addProcess="addProcess" @resetAll="deleteFormProcesses"></add-process>
                </div>

                <table v-if="form.processes.length" class="mt-6 min-w-full divide-y divide-gray-200 text-sm">
                    <thead>
                    <tr class="text-left text-gray-500">
                        <th class="py-2 pr-4">Secuencia</th>
                        <th class="py-2 pr-4">Proceso</th>
                        <th class="py-2 pr-4">Fecha tentativa finalización</th>
                        <th class="py-2 pr-4 text-center">Acciones</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                    <tr v-for="(item, i) in form.processes" :key="i">
                        <td class="py-2 pr-4">{{ item.process.sequence }}</td>
                        <td class="py-2 pr-4">{{ item.process.name }}</td>
                        <td class="py-2 pr-4">{{ completionDateFormatted(item) }}</td>
                        <td class="py-2 pr-4 text-center">
                            <button type="button" class="text-red-500 hover:underline text-xs" @click="deleteProcess(item)"> Eliminar </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <p v-else class="mt-6 text-sm text-gray-400"> No se han encontrado procesos aplicados a este cliente </p>

                <jet-button class="mt-6" :disabled="!form.processes.length > 0" @click="confirmingCreateWorksheetProcess = true">
                    Relacionar a Hoja de trabajo
                </jet-button>

                <svg v-if="showProgressCircular" class="animate-spin ml-3 h-5 w-5 text-primary inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                </svg>
            </div>

            <jet-dialog-modal :show="confirmingCreateWorksheetProcess" @close="confirmingCreateWorksheetProcess = false">
                <template #title> Confirmar creación </template>
                <template #content>
                    ¿Está seguro de relacionar los procesos seleccionados a la Hoja de trabajo para el período
                    <strong>{{ form.worksheet.period.date }}</strong>
                    para el cliente <strong>{{ form.worksheet.customer.name }}</strong>?
                </template>
                <template #footer>
                    <jet-secondary-button @click="confirmingCreateWorksheetProcess = false"> No, cancelar </jet-secondary-button>
                    <jet-button class="ml-2" @click="createWorksheetProcess"> Sí, proceder </jet-button>
                </template>
            </jet-dialog-modal>

            <jet-dialog-modal :show="errorsFoundOnCreate.length > 0" @close="confirmingReadErrors" max-width="lg">
                <template #title> Se presentó un problema </template>
                <template #content>
                    <p> Alguno de los datos suministrados presenta inconsistencias o el servidor no se encuentra disponible para procesar la solicitud actual </p>
                    <h4 class="mt-3 mb-1 font-medium">Se encontraron los siguientes errores:</h4>
                    <ul class="list-disc list-inside text-red-500 text-sm">
                        <li v-for="(error, i) in errorsFoundOnCreate" :key="i">{{ error }}</li>
                    </ul>
                    <p class="mt-4 font-medium"> Consulta con el administrador del sistema </p>
                </template>
                <template #footer>
                    <jet-button @click="confirmingReadErrors"> Ok </jet-button>
                </template>
            </jet-dialog-modal>
        </template>
    </worksheet-layout>
</template>

<script>
import WorksheetLayout from "@/Layouts/WorksheetLayout";
import AddProcess from "@/Components/Forms/WorksheetProcess/AddProcess";
import FormSelect from "@/Components/Forms/Select";
import JetLabel from "@/Jetstream/Label";
import JetButton from "@/Jetstream/Button";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import JetDialogModal from "@/Jetstream/DialogModal";
import moment from 'moment'

moment.locale('es')

export default {
    name: "CreateWorksheetProcessForm",

    components: {
        WorksheetLayout,
        AddProcess,
        FormSelect,
        JetLabel,
        JetButton,
        JetSecondaryButton,
        JetDialogModal,
    },

    props: {
        worksheet: {
            type: Object,
            required: false,
            default: () => ({}),
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
            customerLabel: 'Elige un cliente',
            periodLabel: 'Elige un período',
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
                for (const worksheet of worksheets) {
                    let customer = worksheet[0].customer
                    this.worksheets.customers.push({id: customer.id, name: customer.info.thirdName})

                    worksheet.forEach((period) => {
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

        customerSelected(value) {
            this.form.worksheet.customer.id = value.id
            this.customerLabel = value.name
        },

        periodSelected(value) {
            this.form.worksheet.period.id_worksheet = value.id
            this.periodLabel = value.name
        },

        // Function that adds the process passed to the array of the object form.processes
        addProcess(process) {
            // Remove processes to avoid duplicates
            this.removeProcessFromListProcesses(process)
            // Add new process to the form
            this.form.processes.push(process)
        },

        removeProcessFromListProcesses(process) {
            this.worksheet.processes = this.worksheet.processes.filter((value, index, arr) => {
                return value.id_process !== process.id_process ? value : arr.splice(index, 1)
            })
        },

        deleteProcess(process) {
            let processIndex = this.form.processes.indexOf(process)
            // Add the current process back to the list of processes selectable
            this.worksheet.processes.push({
                id_process: process.id_process,
                name: process.process.name,
                sequence: process.process.sequence
            })
            // Finally, drop the process from the list
            this.form.processes.splice(processIndex, 1)
        },

        completionDateFormatted(item) {
            return moment(item.completion_date).format('dddd, D MMMM, YYYY')
        },

        deleteFormProcesses() {
            for (const process of [...this.form.processes]) {
                this.deleteProcess(process)
            }
        },

        getCustomerFromList(id) {
            return _.find(this.listCustomers, (element) => element.id === id)
        },

        getPeriodFromList(id) {
            return _.find(this.listPeriods, (element) => element.id === id)
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
        listProcesses() {
            let listProcesses = [];
            for (const process of this.worksheet.processes) {
                listProcesses.push({name: process.name, id: process.id_process, sequence: process.sequence})
            }
            return _.sortBy(listProcesses, ['sequence'])
        },

        listCustomers() {
            let listCustomers = []
            for (const customer of this.worksheets.customers) {
                listCustomers.push({id: customer.id, name: customer.name})
            }
            return listCustomers
        },

        listPeriods() {
            let listPeriods = []
            if (this.form.worksheet.customer.id !== '') {
                this.worksheets.periods.filter((key) => {
                    if (key.idCustomer === this.form.worksheet.customer.id) {
                        listPeriods.push({id: key.idWorksheet, name: key.period})
                    }
                });
            }
            return listPeriods
        },

        showAddProcess() {
            return this.listProcesses.length > 0 && this.form.worksheet.customer.id !== '' && this.form.worksheet.period.id_worksheet !== ''
        }
    },

    watch: {
        'form.worksheet.customer.id'(newValue) {
            this.form.worksheet.period.date = ''
            this.periodLabel = 'Elige un período'
            const customer = this.getCustomerFromList(newValue)
            this.form.worksheet.customer.name = customer ? customer.name : ''
        },

        'form.worksheet.period.id_worksheet'(newValue) {
            const period = this.getPeriodFromList(newValue)
            this.form.worksheet.period.date = period ? period.name : ''
            axios.get('/api/worksheet/' + this.form.worksheet.customer.id + '/' + this.form.worksheet.period.date)
                .then((response) => {
                    let worksheet = response.data
                    worksheet.worksheetProcesses.forEach((worksheetProcess) => {
                        let process = {
                            completion_date: worksheetProcess.idealCompletionDate,
                            id_process: worksheetProcess.process.id,
                            process: {
                                name: worksheetProcess.process.name,
                                sequence: worksheetProcess.process.sequence
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

        'form.errors'(newValue) {
            this.confirmingCreateWorksheetProcess = false
            let errors = Object.values(this.form.errors)
            errors.forEach((element) => {
                this.errorsFoundOnCreate.push(element)
            })
        }
    },
};
</script>
