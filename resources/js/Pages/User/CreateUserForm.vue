<template>
    <app-layout>
        <template #content>
            <jet-form-section @submitted="createUser">
                <template #title> Create a user</template>
                <template #description> Crear nuevo usuario</template>
                <template #form>
                    <div class="col-span-6 sm:col-span-2">
                        <jet-label for="nit" value="Número de identificación" class="truncate" />
                        <jet-input id="nit" type="text" class="mt-1 block w-full" :class="{'text-gray-400' : form.id}"
                                   :disabled="form.id"
                                   v-model="dataNit"></jet-input>
                        <p v-if="!form.id" class="mt-1 text-gray-400 text-xs leading-3"> {{ resultSearch }} </p>
                        <jet-input-error :message="form.errors.id" class="mt-2 font-medium"></jet-input-error>
                        <input type="hidden" name="id" v-model="form.id">
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <jet-label for="name" value="Nombre" class="truncate" />
                        <jet-input id="name" type="text" class="mt-1 block w-full text-gray-400" disabled
                                   v-model="form.name"></jet-input>
                        <jet-input-error :message="form.errors.name" class="mt-2 font-medium" />
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <jet-label for="email" value="Email" class="truncate" />
                        <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email"
                                   autocomplete="new-email" ref="email"></jet-input>
                        <jet-input-error :message="form.errors.email" class="mt-2 font-medium" />
                        <p v-if="form.email" class="mt-1 text-gray-400 text-xs leading-3">
                            Este correo será usado para la autenticación
                        </p>
                    </div>
                    <div class="col-span-6 sm:col-span-3 sm:col-start-1">
                        <jet-label for="password" value="Contraseña" class="truncate" />
                        <jet-input id="password" type="password" class="mt-1 block w-full" v-model="form.password"
                                   autocomplete="new-password" ref="password"></jet-input>
                        <jet-input-error :message="form.errors.password" class="mt-2 font-medium" />
                    </div>
                    <div class="col-span-6 sm:col-span-3 sm:col-start-1">
                        <jet-label for="password_confirmation" value="Confirmar contraseña" class="truncate" />
                        <jet-input id="password_confirmation" type="password" class="mt-1 block w-full"
                                   v-model="form.password_confirmation"
                                   autocomplete="new-password_confirmation" ref="password_confirmation"></jet-input>
                        <jet-input-error :message="form.errors.password_confirmation" class="mt-2 font-medium" />
                        <jet-input-error v-if="!confirmPassword" message="Confirmación de contraseña fallida"
                                         class="mt-2 font-medium" />
                    </div>
                </template>
                <template #actions>
                    <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                        Usuario creado
                    </jet-action-message>
                    
                    <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Crear usuario
                    </jet-button>
                </template>
            </jet-form-section>
        </template>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetButton from "@/Jetstream/Button";
import JetFormSection from "@/Jetstream/FormSection"
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";

export default {
    name: "CreateUserForm",
    components: {
        AppLayout,
        JetActionMessage,
        JetButton,
        JetFormSection,
        JetLabel,
        JetInput,
        JetInputError
    },

    props: {
        third: null
    },

    data() {
        return {
            form: this.$inertia.form({
                id: '',
                name: '',
                email: '',
                password: '',
                password_confirmation: ''
            }),
            dataNit: null,
            resultSearch: '',
        }
    },

    beforeMount() {
        this.dataNit = this.third ? this.third.nit : null;
        this.form.id = this.third ? this.third.id : null;
        this.form.name = this.third ? this.third.name : null;
        this.form.email = this.third ? this.third.email : null;
    },

    created() {
        this.debounceFindThird = _.debounce(this.findThird, 1000);
    },

    watch: {
        dataNit(newValue, oldValue) {
            this.resultSearch = 'Buscar un número de identificación';
            this.debounceFindThird();
        }
    },

    computed: {
        confirmPassword() {
            return this.form.password === this.form.password_confirmation;
        }
    },

    methods: {
        findThird() {
            let id;
            const nit = this.dataNit;
            if (nit.length < 7 || nit.length > 10) {
                this.resultSearch = 'Número de identificación no válida';
            } else {
                this.resultSearch = 'Buscando...';
                id = axios.get('/api/third/nit/' + this.dataNit)
                    .then((response) => {
                        if (response.data.length > 0) {
                            this.resultSearch = 'Third found!';
                            response.data.forEach((element) => {
                                this.form.id = element.id_third;
                                this.form.name = element.third_name;
                                this.form.email = element.email;
                            })
                        } else {
                            this.resultSearch = 'Número de identificación no hallado';
                        }
                        // console.log(response.data.length);
                    })
                    .catch((error) => {
                        this.resultSearch = 'Imposible conectar al servidor. ' + error;
                    })
            }
        },

        createUser() {
            if (this.confirmPassword) {
                this.form.post(route('user.new'), {
                    errorBag: 'createUser',
                    preserveScroll: true,
                    onSuccess: () => this.form.reset()
                })
            } else {
                alert('Se necesita confirmar la contraseña')
            }
        }
    },
}
</script>

<style scoped>

</style>
