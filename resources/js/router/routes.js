function page (path) {
  return () => import(/* webpackChunkName: '' */ `~/pages/${path}`).then(m => m.default || m)
}

export default [
  { path: '/', redirect: {name: "dashboard"} },
  { path: '/groups', name: 'groups', component: page('groups.vue') },
  { path: '/report/:id', name: 'report.view', component: page('reports/view.vue') },
  { path: '/reports', name: 'reports', component: page('reports/index.vue') },
  { path: '/report/create', name: 'report.create', component: page('reports/create.vue') },
  { path: '/customers', name: 'customers', component: page('customers/index.vue') },
  { path: '/customer/create', name: 'customer.create', component: page('customers/create.vue') },
  { path: '/customer/:id', name: 'customer.view', component: page('customers/view.vue') },

  { path: '/deskpro', name: 'deskpro', component: page('deskpro.vue') },
  { path: '/dashboard', name: 'dashboard', component: page('dashboard.vue') },
  { path: '/settings/report', name: 'settings.report', component: page('settings.vue') },

  { path: '/login', name: 'login', component: page('auth/login.vue') },
  { path: '/register', name: 'register', component: page('auth/register.vue') },
  // { path: '/password/reset', name: 'password.request', component: page('auth/password/email.vue') },
  // { path: '/password/reset/:token', name: 'password.reset', component: page('auth/password/reset.vue') },
  // { path: '/email/verify/:id', name: 'verification.verify', component: page('auth/verification/verify.vue') },
  // { path: '/email/resend', name: 'verification.resend', component: page('auth/verification/resend.vue') },

  { path: '/home', redirect: {name: "dashboard"} },
  { path: '/settings/profile', name: 'settings.profile', component: page('settings/profile.vue') },
  { path: '/settings/password', name: 'settings.password', component: page('settings/password.vue') },
  // {
  //   path: '/settings',
  //   component: page('settings/index.vue'),
  //   children: [
  //     { path: '', redirect: { name: 'settings.profile' } },
  //     { path: 'profile', name: 'settings.profile', component: page('settings/profile.vue') },
  //     { path: 'password', name: 'settings.password', component: page('settings/password.vue') }
  //   ]
  // },

  { path: '*', component: page('errors/404.vue') }
]
