<template>
    <worksheet-layout>
        <template #toolbarTitle> Hoja de trabajo </template>
        <template #main>
            <div class="bg-white shadow rounded-lg p-6 max-w-lg">
                <h2 class="text-xl font-semibold text-gray-800"> Crear nueva Hoja de trabajo </h2>
                <p class="mt-1 text-sm text-gray-500"> Crea una nueva Hoja de trabajo para configurar los procesos que se aplicarán en el período que elija. </p>

                <div class="mt-6">
                    <create-worksheet-form :customers="listCustomers"></create-worksheet-form>
                </div>
            </div>
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
