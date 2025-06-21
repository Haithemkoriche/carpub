// export default [
//   {
//     title: 'Home',
//     to: { name: 'root' },
//     icon: { icon: 'tabler-smart-home' },
//   },
//   {
//     title: 'Second page',
//     to: { name: 'second-page' },
//     icon: { icon: 'tabler-file' },
//   },
//   {
//     title: 'Login',
//     to: { name: 'login' },
//     icon: { icon: 'tabler-login' },
//   },
//   {
//     title: 'Register',
//     to: { name: 'register' },
//     icon: { icon: 'tabler-login' },
//   },
// ]
export default [
  // 🔐 Shared Pages (All Roles)
  {
    title: 'Login',
    to: { name: 'login' },
    icon: { icon: 'tabler-login' },
    role: ['guest'],
  },
  {
    title: 'Register',
    to: { name: 'register' },
    icon: { icon: 'tabler-user-plus' },
    role: ['guest'],
  },
  // {
  //   title: 'Forgot Password',
  //   to: { name: 'ForgotPassword' },
  //   icon: { icon: 'tabler-lock' },
  //   role: ['guest'],
  // },
  // {
  //   title: 'Help Center',
  //   to: { name: 'HelpCenter' },
  //   icon: { icon: 'tabler-help-circle' },
  //   role: ['admin', 'proprietaire', 'entreprise'],
  // },
  // {
  //   title: 'Settings',
  //   to: { name: 'Settings' },
  //   icon: { icon: 'tabler-settings' },
  //   role: ['admin', 'proprietaire', 'entreprise'],
  // },
  // {
  //   title: 'Terms & Conditions',
  //   to: { name: 'TermsConditions' },
  //   icon: { icon: 'tabler-file-description' },
  //   role: ['admin', 'proprietaire', 'entreprise'],
  // },

  // 🧑‍💼 Admin Pages
  {
    title: 'Admin',
    icon: { icon: 'tabler-shield-check' },
    role: ['admin'],
    children: [
      {
        title: 'Dashboard',
        to: { name: 'admin-dashboard' },
      },
      {
        title: 'Add Campaign',
        to: { name: 'admin-AddCampaign' },
      },
      {
        title: 'Admin Panel',
        to: { name: 'admin-AdminPanel' },
      },
      {
        title: 'Garage Manager',
        to: { name: 'admin-GarageManager' },
      },
      {
        title: 'Vehicle Manager',
        to: { name: 'admin-VehicleManager' },
      },
      {
        title: 'Contract Manager',
        to: { name: 'admin-ContractManager' },
      },
      {
        title: 'Payment Manager',
        to: { name: 'admin-PaymentManager' },
      },
      {
        title: 'Companies',
        to: { name: 'admin-CompanyList' },
      },
      {
        title: 'Users',
        to: { name: 'admin-UserManager' },
      },
    ],
  },

  // 🚗 Propriétaire (Owner) Pages
  {
    title: 'Propriétaire',
    icon: { icon: 'tabler-car' },
    role: ['proprietaire'],
    children: [
      {
        title: 'Dashboard',
        to: { name: 'owner-OwnerDashboard' },
      },
      {
        title: 'Register Vehicle',
        to: { name: 'owner-RegisterVehicle' },
      },
      {
        title: 'My Profile',
        to: { name: 'owner-Profile' },
      },
      {
        title: 'Vehicle Status',
        to: { name: 'owner-VehicleStatus' },
      },
      {
        title: 'My Contracts',
        to: { name: 'owner-ContractView' },
      },
      {
        title: 'Payment History',
        to: { name: 'owner-PaymentHistory' },
      },
    ],
  },

  // 🏢 Entreprise (Company) Pages
  {
    title: 'Entreprise',
    icon: { icon: 'tabler-building' },
    role: ['entreprise'],
    children: [
      {
        title: 'Dashboard',
        to: { name: 'company-CompanyDashboard' },
      },
      {
        title: 'Profile',
        to: { name: 'company-CompanyProfile' },
      },
      {
        title: 'Campaigns',
        to: { name: 'company-CampaignList' },
      },
      {
        title: 'Campaign Vehicles',
        to: { name: 'company-CampaignVehicles' },
      },
    ],
  },

  // 🔒 Hidden/Access Pages
  // {
  //   title: 'Access Denied',
  //   to: { name: 'AccessDenied' },
  //   icon: { icon: 'tabler-ban' },
  //   role: ['admin', 'proprietaire', 'entreprise'],
  //   disabled: true,
  // },
  // {
  //   title: '404 Not Found',
  //   to: { name: 'NotFound' },
  //   icon: { icon: 'tabler-alert-triangle' },
  //   role: ['admin', 'proprietaire', 'entreprise'],
  //   disabled: true,
  // },
]
