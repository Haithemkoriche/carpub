// export default [
//   {
//     title: 'Accueil',
//     to: { name: 'root' },
//     icon: { icon: 'tabler-smart-home' },
//   },
//   {
//     title: 'Deuxième page',
//     to: { name: 'second-page' },
//     icon: { icon: 'tabler-file' },
//   },
//   {
//     title: 'Connexion',
//     to: { name: 'login' },
//     icon: { icon: 'tabler-login' },
//   },
//   {
//     title: 'Inscription',
//     to: { name: 'register' },
//     icon: { icon: 'tabler-login' },
//   },
// ]
export default [
  // 🔐 Pages partagées (Tous rôles)
  {
    title: 'Connexion',
    to: { name: 'login' },
    icon: { icon: 'tabler-login' },
    role: ['guest'],
  },
  {
    title: 'Inscription',
    to: { name: 'register' },
    icon: { icon: 'tabler-user-plus' },
    role: ['guest'],
  },
  // {
  //   title: 'Mot de passe oublié',
  //   to: { name: 'ForgotPassword' },
  //   icon: { icon: 'tabler-lock' },
  //   role: ['guest'],
  // },
  // {
  //   title: 'Centre d\'aide',
  //   to: { name: 'HelpCenter' },
  //   icon: { icon: 'tabler-help-circle' },
  //   role: ['admin', 'proprietaire', 'entreprise'],
  // },
  // {
  //   title: 'Paramètres',
  //   to: { name: 'Settings' },
  //   icon: { icon: 'tabler-settings' },
  //   role: ['admin', 'proprietaire', 'entreprise'],
  // },
  // {
  //   title: 'Conditions générales',
  //   to: { name: 'TermsConditions' },
  //   icon: { icon: 'tabler-file-description' },
  //   role: ['admin', 'proprietaire', 'entreprise'],
  // },

  // 🧑‍💼 Pages Admin
  {
    title: 'Administration',
    icon: { icon: 'tabler-shield-check' },
    role: ['admin'],
    children: [
      {
        title: 'Tableau de bord',
        to: { name: 'admin-dashboard' },
      },
      {
        title: 'Ajouter une campagne',
        to: { name: 'admin-AddCampaign' },
      },
      {
        title: 'Panneau d\'administration',
        to: { name: 'admin-AdminPanel' },
      },
      {
        title: 'Gestionnaire de garage',
        to: { name: 'admin-GarageManager' },
      },
      {
        title: 'Gestionnaire de véhicules',
        to: { name: 'admin-VehicleManager' },
      },
      {
        title: 'Gestionnaire de contrats',
        to: { name: 'admin-ContractManager' },
      },
      {
        title: 'Gestionnaire de paiements',
        to: { name: 'admin-PaymentManager' },
      },
      {
        title: 'Entreprises',
        to: { name: 'admin-CompanyList' },
      },
      {
        title: 'Utilisateurs',
        to: { name: 'admin-UserManager' },
      },
    ],
  },

  // 🚗 Pages Propriétaire
  {
    title: 'Propriétaire',
    icon: { icon: 'tabler-car' },
    role: ['proprietaire'],
    children: [
      {
        title: 'Tableau de bord',
        to: { name: 'owner-OwnerDashboard' },
      },
      {
        title: 'Enregistrer un véhicule',
        to: { name: 'owner-RegisterVehicle' },
      },
      {
        title: 'Mon profil',
        to: { name: 'owner-Profile' },
      },
      {
        title: 'Statut du véhicule',
        to: { name: 'owner-VehicleStatus' },
      },
      {
        title: 'Mes contrats',
        to: { name: 'owner-ContractView' },
      },
      {
        title: 'Historique des paiements',
        to: { name: 'owner-PaymentHistory' },
      },
    ],
  },

  // 🏢 Pages Entreprise
  {
    title: 'Entreprise',
    icon: { icon: 'tabler-building' },
    role: ['entreprise'],
    children: [
      {
        title: 'Tableau de bord',
        to: { name: 'company-CompanyDashboard' },
      },
      {
        title: 'Profil',
        to: { name: 'company-CompanyProfile' },
      },
      {
        title: 'Campagnes',
        to: { name: 'company-CampaignList' },
      },
      {
        title: 'Véhicules de campagne',
        to: { name: 'company-CampaignVehicles' },
      },
    ],
  },

  // 🔒 Pages cachées/accès
  // {
  //   title: 'Accès refusé',
  //   to: { name: 'AccessDenied' },
  //   icon: { icon: 'tabler-ban' },
  //   role: ['admin', 'proprietaire', 'entreprise'],
  //   disabled: true,
  // },
  // {
  //   title: '404 Non trouvé',
  //   to: { name: 'NotFound' },
  //   icon: { icon: 'tabler-alert-triangle' },
  //   role: ['admin', 'proprietaire', 'entreprise'],
  //   disabled: true,
  // },
]
