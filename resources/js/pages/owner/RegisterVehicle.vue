<!-- src/pages/owner/RegisterVehicle.vue -->
<script setup>
definePage({
    name: 'owner-RegisterVehicle',

  meta: {
    layout: 'default',
    requiresAuth: true,
    role: 'proprietaire',
  },
})

import { ref } from 'vue'
import axios from 'axios'

const form = ref({
  marque: '',
  modele: '',
  immatriculation: '',
  photo: null,
})

const isLoading = ref(false)

function handlePhoto(file) {
  form.value.photo = file
}

async function submitForm() {
  try {
    isLoading.value = true
    const formData = new FormData()
    Object.entries(form.value).forEach(([key, val]) => {
      formData.append(key, val)
    })

    await axios.post('/api/vehicles', formData)
    alert('Véhicule soumis avec succès !')
    form.value = {
      marque: '',
      modele: '',
      immatriculation: '',
      photo: null,
    }
  } catch (err) {
    console.error(err)
    alert('Erreur lors de l’enregistrement.')
  } finally {
    isLoading.value = false
  }
}
</script>

<template>
  <VContainer>
    <VCard>
      <VCardTitle>🚗 Enregistrer un Véhicule</VCardTitle>
      <VCardText>
        <VForm @submit.prevent="submitForm">
          <VRow>
            <VCol cols="12" md="6">
              <AppTextField
                v-model="form.marque"
                label="Marque"
                placeholder="Peugeot, Renault, etc."
                required
              />
            </VCol>

            <VCol cols="12" md="6">
              <AppTextField
                v-model="form.modele"
                label="Modèle"
                placeholder="208, Clio, etc."
                required
              />
            </VCol>

            <VCol cols="12" md="6">
              <AppTextField
                v-model="form.immatriculation"
                label="Immatriculation"
                placeholder="1234-AB-01"
                required
              />
            </VCol>

            <VCol cols="12" md="6">
              <VFileInput
                label="Photo du véhicule"
                accept="image/*"
                @update:modelValue="handlePhoto"
                required
              />
            </VCol>

            <VCol cols="12">
              <VBtn
                type="submit"
                :loading="isLoading"
                block
                color="primary"
              >
                Soumettre
              </VBtn>
            </VCol>
          </VRow>
        </VForm>
      </VCardText>
    </VCard>
  </VContainer>
</template>
