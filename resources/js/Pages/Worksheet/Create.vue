<template>
    <worksheet-layout>
        <template #toolbarTitle> Worksheet </template>
        <template #main>
            <v-container>
                <!-- Title &ndash;&gt;-->
                <v-row>
                    <v-col cols="12">
                        <h2> Crear nueva Hoja de trabajo </h2>
                        <p> Crea una nueva Hoja de trabajo para configurar los procesos que se aplicarán en el período que elija. </p>
                    </v-col>
                </v-row>
                <v-spacer></v-spacer>
                <v-row><v-col cols="12" sm="5">
                    <create-worksheet-form :customers="listCustomers"></create-worksheet-form>
                </v-col></v-row>
            </v-container>
        </template>
    </worksheet-layout>
</template>

<script>
import WorksheetLayout from "../../Layouts/WorksheetLayout.vue";
import CreateWorksheetForm from '../../Components/Forms/Worksheet/CreateWorksheetForm'

export default {
    components: {
        WorksheetLayout,
        CreateWorksheetForm
    },

    props: {
        customers: {
            default: null,
            required: true
        },
    },

    mounted() {
        // console.log(this.customers)
        // this.listProcesses;
    },

    computed: {
        // Function that return an array with the customers data received from the server and ready for read
        listCustomers() {
            let listCustomers = [];
            for (const customer of this.customers) {
                listCustomers.push({name: customer.info.thirdName, id: customer.id})
            }
            return listCustomers;
        },
    },
}
</script>
