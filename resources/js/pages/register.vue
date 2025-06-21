<template>
  <VCard class="mx-auto" max-width="500">
    <VCardTitle class="text-center py-6">
      <h2>Créer un compte</h2>
    </VCardTitle>
    
    <VCardText>
      <VForm @submit.prevent="handleRegister">
        <VTextField
          v-model="form.name"
          label="Nom complet"
          variant="outlined"
          :error-messages="errors.name"
          required
        />
        
        <VTextField
          v-model="form.email"
          label="Email"
          type="email"
          variant="outlined"
          :error-messages="errors.email"
          required
          class="mt-4"
        />
        
        <VTextField
          v-model="form.password"
          label="Mot de passe"
          type="password"
          variant="outlined"
          :error-messages="errors.password"
          required
          class="mt-4"
        />
        
        <VTextField
          v-model="form.password_confirmation"
          label="Confirmer le mot de passe"
          type="password"
          variant="outlined"
          :error-messages="errors.password_confirmation"
          required
          class="mt-4"
        />
        
        <VSelect
          v-model="form.role"
          label="Type de compte"
          :items="roles"
          item-title="label"
          item-value="value"
          variant="outlined"
          :error-messages="errors.role"
          required
          class="mt-4"
        />
        
        <!-- Champs spécifiques entreprise -->
        <template v-if="form.role === 'entreprise'">
          <VTextField
            v-model="form.company_name"
            label="Nom de l'entreprise"
            variant="outlined"
            :error-messages="errors.company_name"
            required
            class="mt-4"
          />
          
          <VTextField
            v-model="form.company_sector"
            label="Secteur d'activité"
            variant="outlined"
            :error-messages="errors.company_sector"
            required
            class="mt-4"
          />
          
          <VTextField
            v-model="form.company_phone"
            label="Téléphone"
            variant="outlined"
            :error-messages="errors.company_phone"
            class="mt-4"
          />
        </template>
        
        <VAlert
          v-if="error"
          type="error"
          class="mt-4"
        >
          {{ error }}
        </VAlert>
        
        <VBtn
          type="submit"
          color="primary"
          block
          class="mt-6"
          :loading="loading"
        >
          Créer le compte
        </VBtn>
        
        <div class="text-center mt-4">
          <RouterLink to="/login" class="text-primary">
            Déjà un compte ? Se connecter
          </RouterLink>
        </div>
      </VForm>
    </VCardText>
  </VCard>
</template>

<script setup>
import { ref, reactive } from 'vue'
import { useRouter } from 'vue-router'
// import { useAuthStore } from '@/stores/auth'
import AuthProvider from '@/views/pages/authentication/AuthProvider.vue'
import { useApi } from '@/composables/useApi'

const router = useRouter()
const authStore = AuthProvider()
const { loading, error, execute } = useApi()

const form = reactive({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
  role: 'proprietaire',
  company_name: '',
  company_sector: '',
  company_phone: ''
})

const errors = ref({})

const roles = [
  { label: 'Propriétaire de véhicule', value: 'proprietaire' },
  { label: 'Entreprise', value: 'entreprise' }
]

const handleRegister = async () => {
  errors.value = {}
  
  try {
    await execute(() => authStore.register(form))
    router.push('/')
  } catch (err) {
    if (err.response?.data?.errors) {
      errors.value = err.response.data.errors
    }
  }
}
</script>
