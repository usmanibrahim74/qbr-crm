<template class="">
  <div class="auth-form">
    <div class="row">
      <div class="col">
        <div class="logo-box"><a href="#" class="logo-text">
          <img :src="getAssetPath('images/cn-logo.png')" class="w-100" alt="">
        </a></div>
        <form @submit.prevent="login" @keydown="form.onKeydown($event)">
          <!-- Email -->
          <div class="form-group">
            <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" :placeholder="$t('email')" class="form-control" type="email" name="email">
            <has-error :form="form" field="email" />
          </div>

          <!-- Password -->
          <div class="form-group">
            <input v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }" :placeholder="$t('password')" class="form-control" type="password" name="password">
            <has-error :form="form" field="password" />
          </div>

          <v-button :loading="form.busy" :block="true">
            {{ $t('login') }}
          </v-button>
          <login-with-github />

          <div class="auth-options">
            <checkbox v-model="remember" name="remember" :class="'form-group'">
              {{ $t('remember_me') }}
            </checkbox>

<!--            <router-link :to="{ name: 'password.request' }" class="forgot-link">-->
<!--              {{ $t('forgot_password') }}-->
<!--            </router-link>-->
          </div>

        </form>
      </div>
    </div>
  </div>
</template>

<script>
import Form from 'vform'
import Cookies from 'js-cookie'
import LoginWithGithub from '~/components/LoginWithGithub'

export default {
  components: {
    LoginWithGithub
  },
  layout:"guest",

  middleware: 'guest',

  metaInfo () {
    return { title: this.$t('login') }
  },

  data: () => ({
    form: new Form({
      email: '',
      password: ''
    }),
    remember: false
  }),

  methods: {
    async login () {
      // Submit the form.
      const { data } = await this.form.post('/api/login')

      // Save the token.
      this.$store.dispatch('auth/saveToken', {
        token: data.token,
        remember: this.remember
      })

      // Fetch the user.
      await this.$store.dispatch('auth/fetchUser')

      // Redirect home.
      this.redirect()
    },

    redirect () {
      const intendedUrl = Cookies.get('intended_url')

      if (intendedUrl) {
        Cookies.remove('intended_url')
        this.$router.push({ path: intendedUrl })
      } else {
        this.$router.push({ name: 'home' })
      }
    }
  }
}
</script>
