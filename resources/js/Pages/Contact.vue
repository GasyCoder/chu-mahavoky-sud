<script setup>
import { ref, onMounted } from 'vue';
import { useForm, Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import Button from '@/Components/Ui/Button.vue';
import TextInput from '@/Components/Forms/TextInput.vue';
import Checkbox from '@/Components/Forms/Checkbox.vue';

const props = defineProps({
    settings: {
        type: Object,
        default: () => ({})
    }
});

const form = useForm({
    name: '',
    email: '',
    phone: '',
    subject: '',
    message: '',
    privacy: false
});

const submit = () => {
    form.post(route('contact.submit'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
        }
    });
};

const subjectOptions = [
    { value: '', label: 'Sélectionnez un sujet' },
    { value: "Demande d'informations", label: "Demande d'informations" },
    { value: 'Rendez-vous', label: 'Rendez-vous' },
    { value: 'Carrières', label: 'Carrières' },
    { value: 'Commentaires', label: 'Commentaires' },
    { value: 'Autre', label: 'Autre' }
];

onMounted(() => {
    if (typeof AOS !== 'undefined') {
        AOS.init({
            once: true,
            duration: 800,
            offset: 50
        });
    }
});
</script>

<template>
    <AppLayout 
        title="Contact"
        :settings="settings"
    >
        <Head title="Contactez-nous" />

        <!-- Banner -->
        <section 
            class="relative h-[40vh] bg-cover bg-center bg-fixed"
            :style="{ backgroundImage: `url(${ '/assets/contact-banner.jpg' })` }"
        >
            <div class="absolute inset-0 bg-gradient-to-r from-slate-900/80 to-primary/50"></div>
            <div class="container relative flex h-full items-center justify-center">
                <div class="text-center">
                    <h3 
                        class="text-4xl font-bold text-white mb-4" 
                        data-aos="fade-up" 
                        data-aos-duration="1000"
                    >
                        Contactez-nous
                    </h3>
                    <p 
                        class="mt-4 text-white/70 max-w-xl mx-auto" 
                        data-aos="fade-up" 
                        data-aos-delay="400" 
                        data-aos-duration="1000"
                    >
                        Nous sommes a votre disposition pour repondre a toutes vos questions
                    </p>
                </div>
            </div>
        </section>

        <!-- Breadcrumb -->
        <div class="bg-gray-light py-3">
            <div class="container">
                <div class="flex items-center text-sm">
                    <Link href="/" class="text-primary hover:text-primary/80 transition-colors">Accueil</Link>
                    <span class="mx-2 text-gray-dark">/</span>
                    <span class="text-gray-dark">Contact</span>
                </div>
            </div>
        </div>

        <!-- Alerte urgence -->
        <div class="container mt-8">
            <div 
                class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-r-xl" 
                data-aos="fade-up" 
                data-aos-duration="1000"
            >
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-triangle text-red-500 text-xl"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-lg font-medium text-red-700">Urgences medicales</h3>
                        <div class="mt-2 text-sm text-red-600">
                            <p>
                                Pour toute urgence medicale, appelez immediatement le 
                                <a :href="`tel:${settings?.contact?.emergency}`" class="font-semibold text-red-700">
                                    {{ settings?.contact?.emergency }}
                                </a> 
                                ou rendez-vous directement au service des urgences.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Coordonnees et formulaire -->
        <section class="container py-16">
            <div class="flex flex-col lg:flex-row gap-10">
                <!-- Coordonnees -->
                <div class="w-full lg:w-1/3" data-aos="fade-right" data-aos-duration="1000">
                    <h2 class="text-xl font-bold text-dark mb-6">Nos coordonnees</h2>

                    <!-- Adresse -->
                    <div class="bg-white rounded-2xl shadow-sm p-6 mb-4">
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center text-primary mr-4">
                                <i class="far fa-map-marker-alt text-lg"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-dark text-lg mb-1">Adresse</h3>
                                <p class="text-gray-dark text-sm">{{ settings?.site_name }}</p>
                                <p class="text-gray-dark text-sm">{{ settings?.contact?.address }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Telephone -->
                    <div class="bg-white rounded-2xl shadow-sm p-6 mb-4">
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center text-primary mr-4">
                                <i class="far fa-phone text-lg"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-dark text-lg mb-1">Telephone</h3>
                                <p class="text-gray-dark text-sm">
                                    Accueil: 
                                    <a :href="`tel:${settings?.contact?.phone}`" class="text-primary hover:underline transition-colors">
                                        {{ settings?.contact?.phone }}
                                    </a>
                                </p>
                                <p class="text-gray-dark text-sm">
                                    Urgences (24h/24): 
                                    <a :href="`tel:${settings?.contact?.emergency}`" class="text-primary hover:underline transition-colors">
                                        {{ settings?.contact?.emergency }}
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="bg-white rounded-2xl shadow-sm p-6 mb-4">
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center text-primary mr-4">
                                <i class="far fa-envelope text-lg"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-dark text-lg mb-1">Email</h3>
                                <p class="text-gray-dark text-sm">
                                    Informations: 
                                    <a :href="`mailto:${settings?.contact?.email}`" class="text-primary hover:underline transition-colors">
                                        {{ settings?.contact?.email }}
                                    </a>
                                </p>
                                <p class="text-gray-dark text-sm">
                                    Direction: 
                                    <a :href="`mailto:${settings?.contact?.direction_email}`" class="text-primary hover:underline transition-colors">
                                        {{ settings?.contact?.direction_email }}
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Horaires -->
                    <div class="bg-white rounded-2xl shadow-sm p-6 mb-4">
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center text-primary mr-4">
                                <i class="far fa-clock text-lg"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-dark text-lg mb-1">Horaires d'ouverture</h3>
                                <p class="text-gray-dark text-sm">{{ settings?.hours?.weekdays }}</p>
                                <p class="text-gray-dark text-sm">{{ settings?.hours?.weekend }}</p>
                                <p class="text-gray-dark text-sm">Urgences: 24h/24, 7j/7</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Formulaire -->
                <div class="w-full lg:w-2/3" data-aos="fade-left" data-aos-duration="1000">
                    <h2 class="text-xl font-bold text-dark mb-6">Envoyez-nous un message</h2>

                    <div class="bg-white p-8 rounded-2xl shadow-sm">
                        <!-- Flash Messages -->
                        <div v-if="$page.props.flash.success" class="mb-6 p-4 bg-green-50 text-green-700 border border-green-200 rounded-xl">
                            {{ $page.props.flash.success }}
                        </div>
                        <div v-if="$page.props.flash.error" class="mb-6 p-4 bg-red-50 text-red-700 border border-red-200 rounded-xl">
                            {{ $page.props.flash.error }}
                        </div>

                        <form @submit.prevent="submit">
                            <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">
                                <TextInput
                                    id="name"
                                    v-model="form.name"
                                    type="text"
                                    label="Nom complet"
                                    :required="true"
                                    :error="form.errors.name"
                                    placeholder="Votre nom complet"
                                />
                                <TextInput
                                    id="email"
                                    v-model="form.email"
                                    type="email"
                                    label="Email"
                                    :required="true"
                                    :error="form.errors.email"
                                    placeholder="votre@email.com"
                                />
                            </div>

                            <div class="mb-6">
                                <TextInput
                                    id="phone"
                                    v-model="form.phone"
                                    type="tel"
                                    label="Telephone"
                                    :error="form.errors.phone"
                                    placeholder="Votre numero de telephone"
                                />
                            </div>

                            <div class="mb-6">
                                <div class="w-full">
                                    <label for="subject" class="block mb-1 text-sm font-medium text-dark">
                                        Sujet <span class="text-red-500">*</span>
                                    </label>
                                    <select
                                        id="subject"
                                        v-model="form.subject"
                                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors"
                                        :class="{ 'border-red-500': form.errors.subject }"
                                    >
                                        <option 
                                            v-for="option in subjectOptions" 
                                            :key="option.value" 
                                            :value="option.value"
                                        >
                                            {{ option.label }}
                                        </option>
                                    </select>
                                    <p v-if="form.errors.subject" class="mt-1 text-sm text-red-500">{{ form.errors.subject }}</p>
                                </div>
                            </div>

                            <div class="mb-6">
                                <div class="w-full">
                                    <label for="message" class="block mb-1 text-sm font-medium text-dark">
                                        Message <span class="text-red-500">*</span>
                                    </label>
                                    <textarea
                                        id="message"
                                        v-model="form.message"
                                        rows="6"
                                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors resize-none"
                                        :class="{ 'border-red-500': form.errors.message }"
                                        placeholder="Votre message..."
                                    ></textarea>
                                    <p v-if="form.errors.message" class="mt-1 text-sm text-red-500">{{ form.errors.message }}</p>
                                </div>
                            </div>

                            <div class="mb-6">
                                <Checkbox
                                    v-model="form.privacy"
                                    label="J'accepte que mes donnees soient traitees conformement a la politique de confidentialite du site."
                                    :error="form.errors.privacy"
                                />
                            </div>

                            <Button 
                                type="submit" 
                                variant="primary" 
                                size="lg" 
                                class="w-full"
                                :loading="form.processing"
                            >
                                {{ form.processing ? 'Envoi en cours...' : 'Envoyer le message' }}
                            </Button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>
