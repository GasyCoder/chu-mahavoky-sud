<script setup>
import { ref, onMounted } from 'vue';
import { useForm, Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import PageBanner from '@/Components/Ui/PageBanner.vue';
import Card from '@/Components/Ui/Card.vue';
import Alert from '@/Components/Ui/Alert.vue';
import Button from '@/Components/Ui/Button.vue';
import TextInput from '@/Components/Forms/TextInput.vue';
import SelectInput from '@/Components/Forms/SelectInput.vue';
import TextareaInput from '@/Components/Forms/TextareaInput.vue';
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
        <PageBanner
            title="Contactez-nous"
            description="Nous sommes a votre disposition pour repondre a toutes vos questions"
            label="CHU Mahajanga"
            :breadcrumbs="[
                { label: 'Accueil', route: 'home' },
                { label: 'Contact' }
            ]"
        />

        <!-- Alerte urgence -->
        <div class="max-w-7xl mx-auto px-6 lg:px-8 mt-8" data-aos="fade-up">
            <Alert variant="danger" title="Urgences medicales">
                Pour toute urgence medicale, appelez immediatement le
                <a :href="`tel:${settings?.contact?.emergency}`" class="font-semibold underline">
                    {{ settings?.contact?.emergency }}
                </a>
                ou rendez-vous directement au service des urgences.
            </Alert>
        </div>

        <!-- Coordonnees et formulaire -->
        <section class="py-16 bg-background">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="flex flex-col lg:flex-row gap-10">
                    <!-- Coordonnees -->
                    <div class="w-full lg:w-1/3 space-y-4" data-aos="fade-right">
                        <h2 class="text-xl font-bold text-foreground mb-6">Nos coordonnees</h2>

                        <!-- Adresse -->
                        <Card>
                            <div class="flex items-start">
                                <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center text-primary mr-4 shrink-0">
                                    <i class="far fa-map-marker-alt text-lg"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-foreground text-base mb-1">Adresse</h3>
                                    <p class="text-muted-foreground text-sm">{{ settings?.site_name }}</p>
                                    <p class="text-muted-foreground text-sm">{{ settings?.contact?.address }}</p>
                                </div>
                            </div>
                        </Card>

                        <!-- Telephone -->
                        <Card>
                            <div class="flex items-start">
                                <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center text-primary mr-4 shrink-0">
                                    <i class="far fa-phone text-lg"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-foreground text-base mb-1">Telephone</h3>
                                    <p class="text-muted-foreground text-sm">
                                        Accueil:
                                        <a :href="`tel:${settings?.contact?.phone}`" class="text-primary hover:underline transition-colors">
                                            {{ settings?.contact?.phone }}
                                        </a>
                                    </p>
                                    <p class="text-muted-foreground text-sm">
                                        Urgences (24h/24):
                                        <a :href="`tel:${settings?.contact?.emergency}`" class="text-primary hover:underline transition-colors">
                                            {{ settings?.contact?.emergency }}
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </Card>

                        <!-- Email -->
                        <Card>
                            <div class="flex items-start">
                                <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center text-primary mr-4 shrink-0">
                                    <i class="far fa-envelope text-lg"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-foreground text-base mb-1">Email</h3>
                                    <p class="text-muted-foreground text-sm">
                                        Informations:
                                        <a :href="`mailto:${settings?.contact?.email}`" class="text-primary hover:underline transition-colors">
                                            {{ settings?.contact?.email }}
                                        </a>
                                    </p>
                                    <p class="text-muted-foreground text-sm">
                                        Direction:
                                        <a :href="`mailto:${settings?.contact?.direction_email}`" class="text-primary hover:underline transition-colors">
                                            {{ settings?.contact?.direction_email }}
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </Card>

                        <!-- Horaires -->
                        <Card>
                            <div class="flex items-start">
                                <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center text-primary mr-4 shrink-0">
                                    <i class="far fa-clock text-lg"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-foreground text-base mb-1">Horaires d'ouverture</h3>
                                    <p class="text-muted-foreground text-sm">{{ settings?.hours?.weekdays }}</p>
                                    <p class="text-muted-foreground text-sm">{{ settings?.hours?.weekend }}</p>
                                    <p class="text-muted-foreground text-sm">Urgences: 24h/24, 7j/7</p>
                                </div>
                            </div>
                        </Card>
                    </div>

                    <!-- Formulaire -->
                    <div class="w-full lg:w-2/3" data-aos="fade-left">
                        <h2 class="text-xl font-bold text-foreground mb-6">Envoyez-nous un message</h2>

                        <Card>
                            <!-- Flash Messages -->
                            <Alert v-if="$page.props.flash.success" variant="success" class="mb-6" dismissible>
                                {{ $page.props.flash.success }}
                            </Alert>
                            <Alert v-if="$page.props.flash.error" variant="danger" class="mb-6" dismissible>
                                {{ $page.props.flash.error }}
                            </Alert>

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
                                        icon="far fa-user"
                                    />
                                    <TextInput
                                        id="email"
                                        v-model="form.email"
                                        type="email"
                                        label="Email"
                                        :required="true"
                                        :error="form.errors.email"
                                        placeholder="votre@email.com"
                                        icon="far fa-envelope"
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
                                        icon="far fa-phone"
                                    />
                                </div>

                                <div class="mb-6">
                                    <SelectInput
                                        v-model="form.subject"
                                        label="Sujet"
                                        :required="true"
                                        :options="subjectOptions"
                                        :error="form.errors.subject"
                                        icon="far fa-tag"
                                    />
                                </div>

                                <div class="mb-6">
                                    <TextareaInput
                                        v-model="form.message"
                                        label="Message"
                                        :required="true"
                                        :rows="6"
                                        :error="form.errors.message"
                                        placeholder="Votre message..."
                                    />
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
                                    rounded
                                >
                                    <template #icon>
                                        <i v-if="!form.processing" class="far fa-paper-plane"></i>
                                    </template>
                                    {{ form.processing ? 'Envoi en cours...' : 'Envoyer le message' }}
                                </Button>
                            </form>
                        </Card>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>
