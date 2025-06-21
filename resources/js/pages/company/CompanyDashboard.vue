<script setup>
definePage({
  name: 'company-CompanyDashboard',
  meta: {
    layout: 'default',
    requiresAuth: true,
    role: 'entreprise',
  },
})
</script>
<template>
  <div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Company Dashboard</h1>
    <p>Welcome to your company dashboard. Here you can manage your campaigns, view statistics, and more.</p>
    <!-- Add more content here as needed -->
  </div>
</template>
