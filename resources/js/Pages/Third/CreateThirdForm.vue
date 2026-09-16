<template>
    <app-layout>
        <template #content>
            <jet-form-section @submitted="createThird">
                <template #title> Nueva persona </template>
                <template #description> Diligencia los siguientes datos para iniciar con la creación de un tercero nuevo en la aplicación. </template>
                <template #form>
                    <div class="col-span-3 sm:col-span-2">
                        <jet-label for="thirdRegimeType" value="Tipo de régimen" class="truncate" />
                        <form-select id="thirdRegimeType" :value="thirdRegimeType" :list="listThirdRegimeTypes"
                                     @value="regimeTypeSelected"></form-select>
                        <jet-input-error :message="form.errors.id_regime_type" class="mt-2 font-medium" />
                    </div>
                    <div v-if="isPersonaNatural" class="col-span-3 sm:col-span-1">
                        <jet-label for="identificationType" value="Tipo de identificación" class="truncate" />
                        <form-select id="identificationType" :value="identificationType"
                                     :list="listIdentificationTypes"
                                     @value="identificationTypeSelected"
                                     :disabled="!isPersonaNatural"></form-select>
                        <jet-input-error :message="form.errors.id_identification_type" class="mt-2 font-medium" />
                    </div>
                    <div class="col-span-6"
                         :class="{'sm:col-span-2': !isPersonaNatural, 'sm:col-span-3': isPersonaNatural}">
                        <jet-label for="nit" value="Número de identificación" class="truncate" />
                        <jet-input id="nit" type="text" class="mt-1 block w-full" v-model="form.nit"
                                   autocomplete="new-nit" ref="nit"></jet-input>
                        <jet-input-error :message="form.errors.nit" class="mt-2 font-medium" />
                    </div>
                    <div v-if="isPersonaNatural" class="col-span-6 sm:col-span-2">
                        <jet-label for="name1" value="Primer nombre" />
                        <jet-input id="name1" type="text" class="mt-1 block w-full" v-model="form.name1"
                                   autocomplete="new-name1" ref="name1"></jet-input>
                        <jet-input-error :message="form.errors.name1" class="mt-2 font-medium" />
                    </div>
                    <div v-if="isPersonaNatural" class="col-span-6 sm:col-span-2">
                        <jet-label for="name2" value="Segundo nombre" />
                        <jet-input id="name2" type="text" class="mt-1 block w-full" v-model="form.name2"
                                   autocomplete="new-name2" ref="name2"></jet-input>
                        <jet-input-error :message="form.errors.name2" class="mt-2 font-medium" />
                    </div>
                    <div v-if="isPersonaNatural" class="col-span-6 sm:col-span-2">
                        <jet-label for="lastname1" value="Primer apellido" />
                        <jet-input id="lastname1" type="text" class="mt-1 block w-full" v-model="form.lastname1"
                                   autocomplete="new-lastname1" ref="lastname1"></jet-input>
                        <jet-input-error :message="form.errors.lastname1" class="mt-2 font-medium" />
                    </div>
                    <div v-if="isPersonaNatural" class="col-span-6 sm:col-span-2">
                        <jet-label for="lastname2" value="Segundo apellido" />
                        <jet-input id="lastname2" type="text" class="mt-1 block w-full" v-model="form.lastname2"
                                   autocomplete="new-lastname2" ref="lastname2"></jet-input>
                        <jet-input-error :message="form.errors.lastname2" class="mt-2 font-medium" />
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="third_name" value="Nombre completo" />
                        <jet-input id="third_name" type="text" class="mt-1 block w-full" v-model="thirdName"
                                   autocomplete="new-third-name" ref="third_name"></jet-input>
                        <jet-input-error :message="form.errors.third_name" class="mt-2 font-medium" />
                    </div>
                    <div class="col-span-6 sm:col-span-2 sm:col-start-1">
                        <jet-label for="address" value="Dirección" />
                        <jet-input id="address" type="text" class="mt-1 block w-full" v-model="form.address"
                                   autocomplete="new-address" ref="address"></jet-input>
                        <jet-input-error :message="form.errors.address" class="mt-2 font-medium" />
                    </div>
                    <div class="col-span-6 sm:col-span-2">
                        <jet-label for="city" value="Ciudad" />
                        <form-select id="city" :value="city" :list="listCities" @value="citySelected"></form-select>
                        <jet-input-error :message="form.errors.id_city" class="mt-2 font-medium" />
                    </div>
                    <div class="col-span-6 sm:col-span-2 sm:col-start-1">
                        <jet-label for="phone1" value="Teléfono 1" />
                        <jet-input id="phone1" type="text" class="mt-1 block w-full" v-model="form.phone1"
                                   autocomplete="new-phone1" ref="phone1"></jet-input>
                        <jet-input-error :message="form.errors.phone1" class="mt-2 font-medium" />
                    </div>
                    <div class="col-span-6 sm:col-span-2">
                        <jet-label for="phone2" value="Teléfono 2" />
                        <jet-input id="phone2" type="text" class="mt-1 block w-full" v-model="form.phone2"
                                   autocomplete="new-phone2" ref="phone2"></jet-input>
                        <jet-input-error :message="form.errors.phone2" class="mt-2 font-medium" />
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="email" value="Email" />
                        <jet-input id="email" type="text" class="mt-1 block w-full" v-model="form.email"
                                   autocomplete="new-email" ref="email"></jet-input>
                        <jet-input-error :message="form.errors.email" class="mt-2 font-medium" />
                    </div>
                    <div class="col-span-6">
                        <input type="radio" name="thirdAs" id="asUser" v-model="form.thirdAs" value="user"
                               class="appearance-none checked:bg-primary checked:border-primary">
                        <label for="asUser"
                               class="inline-flex mx-2 font-medium text-sm text-gray-700"> Crear como usuario</label>
                    </div>
                    <div class="col-span-6">
                        <input type="radio" name="thirdAs" id="asCustomer" v-model="form.thirdAs" value="customer"
                               class="appearance-none checked:bg-primary checked:border-primary">
                        <label for="asCustomer" class="inline-flex mx-2 font-medium text-sm text-gray-700"> Crear como cliente</label>
                        <jet-input-error :message="form.errors.thirdAs" class="mt-2 font-medium" />
                    </div>
                </template>
                
                <template #actions>
                    <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                        Creación exitosa
                    </jet-action-message>
        
                    <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Crear tercero
                    </jet-button>
                </template>
            </jet-form-section>
        </template>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import JetFormSection from "@/Jetstream/FormSection";
import JetButton from "@/Jetstream/Button";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import FormSelect from "@/Components/Forms/Select";
import JetCheckbox from "@/Jetstream/Checkbox";

export default {
    name: "CreateThirdForm",

    components: {
        AppLayout,
        JetActionMessage,
        JetButton,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
        JetSecondaryButton,
        FormSelect,
        JetCheckbox
    },

    props: {
        cities: {
            type: Array,
            required: true,
        },
        natureTypes: {
            type: Array,
            required: true,
        },
        identificationTypes: {
            type: Array,
            required: true,
        },
        regimeTypes: {
            type: Array,
            required: true,
        }
    },

    data() {
        return {
            form: this.$inertia.form({
                id_city: '',
                id_nature_type: '',
                id_identification_type: '',
                id_regime_type: '',
                nit: '',
                third_name: '',
                name1: '',
                name2: '',
                lastname1: '',
                lastname2: '',
                address: '',
                phone1: '',
                phone2: '',
                email: '',
                thirdAs: '',
            }),
            city: 'Elige una ciudad',
            natureType: 'Elige un tipo de naturaleza',
            identificationType: 'Elige un tipo de identificación',
            thirdRegimeType: 'Elige un tipo de régimen',
        }
    },

    methods: {
        createThird() {
            this.form.post(route('third.new'), {
                errorBag: 'createThird',
                preserveScroll: true,
                onSuccess: () => this.form.reset()
            })
        },

        citySelected(value) {
            this.form.id_city = value.id;
            this.city = value.name;
        },

        natureTypeSelected(value) {
            this.form.id_nature_type = value.id;
            this.natureType = value.name;
        },

        identificationTypeSelected(value) {
            this.form.id_identification_type = value.id;
            this.identificationType = value.name;
        },

        regimeTypeSelected(value) {
            this.form.id_regime_type = value.id;
            // Set identification type with NIT (id = 1)
            this.form.id_identification_type = 1;
            this.thirdRegimeType = value.name;
        },
    },

    computed: {
        listCities() {
            let listCities = [];
            this.cities.forEach(function (item) {
                listCities.push({'id': item.id_city, 'name': item.name})
            })
            return listCities;
        },
        listNatureTypes() {
            let listNatureTypes = [];
            this.natureTypes.forEach(function (item) {
                listNatureTypes.push({'id': item.id_nature_type, 'name': item.name})
            })
            return listNatureTypes;
        },
        listIdentificationTypes() {
            let listIdentificationTypes = [];
            this.identificationTypes.forEach(function (item) {
                listIdentificationTypes.push({
                    'id': item.id_identification_type,
                    'name': item.code_rips
                })
            })
            return listIdentificationTypes;
        },
        listThirdRegimeTypes() {
            let listRegimeTypes = [];
            this.regimeTypes.forEach(function (item) {
                listRegimeTypes.push({'id': item.id_regime_type, 'name': item.name})
            })
            return listRegimeTypes;
        },
        isPersonaNatural() {
            return this.form.id_regime_type === 3
        },

        thirdName: {
            set: function (newValue) {
                return this.form.third_name = newValue;
            },
            get: function () {
                if (this.isPersonaNatural) {
                    return this.form.third_name = this.form.name1 + ' ' + (this.form.name2 ? this.form.name2 + ' ' : '') + this.form.lastname1 + (this.form.lastname2 ? ' ' + this.form.lastname2 : '');
                } else {
                    return this.form.third_name;
                }
            }
        }
    },

    watch: {
        thirdRegimeType: function () {
            if (this.isPersonaNatural) {
                this.form.id_identification_type = 2;
                this.identificationType = 'CC';
                this.form.id_nature_type = 2;
                this.natureType = 'PERSONA NATURAL';
            } else {
                this.identificationType = 'NIT';
                this.form.id_nature_type = 1;
                this.natureType = 'PERSONA JURÍDICA';
                this.form.name1 = '';
                this.form.name2 = '';
                this.form.lastname1 = '';
                this.form.lastname2 = '';
            }
        }
    },

    mounted() {
    }
}
</script>
