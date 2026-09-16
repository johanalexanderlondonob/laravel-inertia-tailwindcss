<template>
    <worksheet-layout>
        <template #toolbarTitle> Worksheet </template>
        <template #main>
<!--            <h1>Hola, {{ username }}</h1>-->
            <v-item-group>
                <v-row v-if="!customers">
                    <v-col v-for="i in 4" :key="i">
                        <v-skeleton-loader v-bind="attrs" type="card-heading, article, actions"></v-skeleton-loader>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col v-for="(customer, i) in customers" :key="i" cols="12" md="4">
                        <v-item>
                            <v-card>
                                <v-card-title> <span class="d-inline-block text-truncate"> {{ customer.info.thirdName }} </span> </v-card-title>
                                <v-card-text>
                                    <v-simple-table dense>
                                        <tbody>
                                        <tr>
                                            <td>Hojas de trabajo</td>
                                            <td>{{ customer.worksheets.length }}</td>
                                        </tr>
                                        </tbody>
                                    </v-simple-table>
                                </v-card-text>
                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-tooltip v-for="(action, j) in actionsForCustomer" :key="j" bottom>
                                        <template v-slot:activator="{ on, attrs }">
                                            <v-btn
                                                    v-if="action.isVisible(customer.worksheets.length)"
                                                    v-bind="attrs" v-on="on"
                                                    @click="action.event(customer)"
                                                    :color="action.color"
                                                    icon class="mr-2">
                                                <v-icon>{{ action.icon }}</v-icon>
                                            </v-btn>
                                        </template>
                                        <span> {{ action.messageTooltip }}</span>
                                    </v-tooltip>
                                </v-card-actions>
                            </v-card>
                        </v-item>
                    </v-col>
                </v-row>
            </v-item-group>
            <v-dialog v-model="isNewPeriod" max-width="500">
                <v-card>
                    <div class="overline ml-6 pt-4"> Nueva Hoja de trabajo </div>
                    <v-card-title class="headline mb-2 text-truncate"> {{ customer.name }} </v-card-title>
                    <v-card-subtitle> Asignación de período</v-card-subtitle>
                    <v-card-text>
                        <create-worksheet-form :customer="customer.id"></create-worksheet-form>
                    </v-card-text>
                </v-card>
            </v-dialog>
            <v-dialog v-model="isLookingWorksheets" max-width="700">
                <v-card>
                    <div class="overline ml-6 pt-4"> Hojas de trabajo </div>
                    <v-card-title class="headline mb-2 text-truncate"> {{ customer.name }} </v-card-title>
                    <!--                    <v-card-subtitle> Asignación de período</v-card-subtitle>-->
                    <v-card-text>
                        <v-simple-table dense fixed-header>
                            <thead>
                            <tr class="font-weight-bold">
                                <td>Período</td>
                                <td>Fecha creación</td>
                                <td class="text-center">Abierto</td>
                                <td></td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(worksheet, i) in customer.worksheets" :key="i">
                                <td>{{ worksheet.period }}</td>
                                <td>{{ completionDateFormatted(worksheet.createdAt) }}</td>
                                <td class="text-center">{{ worksheet.opened === 'S' ? 'Sí' : 'No' }}</td>
                                <td class="text-center">
                                    <v-btn small text plain color="primary" @click="showWorksheet(worksheet.id)">
                                        Ver
                                    </v-btn>
                                </td>
                            </tr>
                            </tbody>
                        </v-simple-table>
                    </v-card-text>
                </v-card>
            </v-dialog>
        </template>
    </worksheet-layout>
</template>

<script>
import WorksheetLayout from "../../Layouts/WorksheetLayout.vue";
import CreateWorksheetForm from '../../Components/Forms/Worksheet/CreateWorksheetForm';
import moment from "moment";

export default {
    components: {
        WorksheetLayout,
        CreateWorksheetForm
    },

    beforeMount() {
        // this.getWorksheetWithProcesses()
    },

    props: {
        customers: {
            required: true,
            default: null
        }
    },

    data() {
        return {
            attrs: {
                class: 'mb-6',
                boilerplate: false,
                elevation: 2,
            },
            // customers: [],
            customer: {},
            isNewPeriod: false,
            isLookingWorksheets: false,
        }
    },

    methods: {
        getWorksheetWithProcesses() {
            axios
                .get('/api/customer')
                .then((response) => {
                    this.customers = response.data
                })
                .catch((error) => {
                    console.log(error);
                })
        },

        newPeriod(customer) {
            this.isNewPeriod = true
            this.customer = {id: customer.id, name: customer.info.thirdName, worksheets: customer.worksheets}
        },

        newProcess(customer) {
            alert(`Nuevo proceso ${customer}`)
        },

        showWorksheets(customer) {
            this.isLookingWorksheets = true
            this.customer = {id: customer.id, name: customer.info.thirdName, worksheets: customer.worksheets}
        },

        showWorksheet(id) {
            this.$inertia.get(route('worksheet.show', id))
        },

        completionDateFormatted(date) {
            return moment(date).format('dddd, D MMMM, YYYY')
        },
    },

    computed: {
        username() {
            let username = this.$page.props.user.name
            let indexFirstName = username.indexOf(' ')

            if (username.charAt(indexFirstName) !== '') {
                let indexSecondName = username.indexOf(' ', indexFirstName + 1)
                let firstName = username.slice(0, indexFirstName).toLowerCase()
                let secondName = username.slice(indexFirstName + 1, indexSecondName).toLowerCase()
                return firstName.trim().replace(/^\w/, (c) => c.toUpperCase()) + ' ' + secondName.trim().replace(/^\w/, (c) => c.toUpperCase())
            } else {
                return username
            }
        },

        actionsForCustomer() {
            return [
                {
                    isVisible: (numberWorksheets) => {
                        return numberWorksheets > 0
                    },
                    event: (idCustomer) => {
                        this.showWorksheets(idCustomer)
                    },
                    color: 'primary',
                    icon: 'mdi-eye',
                    messageTooltip: 'Ver hoja de trabajo'
                },
                {
                    isVisible: (numberWorksheets) => {
                        return numberWorksheets >= 0
                    },
                    event: (idCustomer) => {
                        this.newPeriod(idCustomer)
                    },
                    color: 'primary',
                    icon: 'mdi-timeline-plus',
                    messageTooltip: 'Crear nuevo período'
                },
                // {
                //     isVisible: (numberWorksheets) => {
                //         return numberWorksheets > 0
                //     },
                //     event: (idCustomer) => {
                //         this.newProcess(idCustomer)
                //     },
                //     color: 'primary',
                //     icon: 'mdi-layers-plus',
                //     messageTooltip: 'Añadir proceso'
                // },
            ]
        }
    },
};
</script>
