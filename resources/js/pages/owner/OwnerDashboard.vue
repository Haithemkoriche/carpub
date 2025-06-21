<!-- src/pages/owner/OwnerDashboard.vue -->
<script setup>
definePage({
    name: 'owner-OwnerDashboard',
  meta: {
    layout: 'default',
    requiresAuth: true,
    role: 'proprietaire',
  },
})

import { ref, onMounted } from 'vue'
import axios from 'axios'

const contracts = ref([])
const payments = ref([])

onMounted(async () => {
  try {
    const resContracts = await axios.get('/api/contracts')
    contracts.value = resContracts.data.data

    const resPayments = await axios.get('/api/payments')
    payments.value = resPayments.data.data
  } catch (err) {
    console.error('Failed to fetch dashboard data', err)
  }
})
</script>

<template>
  <VContainer>
    <VCard class="mb-6">
      <VCardTitle>📄 Mes Contrats</VCardTitle>
      <VCardText>
        <VTable>
          <thead>
            <tr>
              <th>Campagne</th>
              <th>Garage</th>
              <th>Statut</th>
              <th>Montant</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="c in contracts" :key="c.id">
              <td>{{ c.campaign?.nom }}</td>
              <td>{{ c.garage?.nom }}</td>
              <td>{{ c.statut }}</td>
              <td>{{ c.montant_mensuel }} DZD</td>
            </tr>
          </tbody>
        </VTable>
      </VCardText>
    </VCard>

    <VCard>
      <VCardTitle>💰 Paiements Mensuels</VCardTitle>
      <VCardText>
        <VTable>
          <thead>
            <tr>
              <th>Mois</th>
              <th>Montant</th>
              <th>Statut</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="p in payments" :key="p.id">
              <td>{{ p.mois }}</td>
              <td>{{ p.montant }} DZD</td>
              <td>{{ p.status }}</td>
            </tr>
          </tbody>
        </VTable>
      </VCardText>
    </VCard>
  </VContainer>
</template>
