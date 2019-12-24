import formatter from '~/helpers/formatter'

export default {
  data: () => ({
    loading: false,
    valid: true,
    labels: {},
    form: {},
    rules: {},
    errors: {}
  }),
  created() {
      this.rules.required = (field) => ((v) => !!v || 'The ' + (this.labels && this.labels[field] && this.labels[field].toLowerCase() + ' ') + 'field is required')
    },
  mounted() {
      console.log(this.form,"formn")
    for (let key in this.form) {
        console.log(key,"keys");
      if (this.form[key] !== null && typeof this.form[key] === 'object') {
        for (let i in this.form[key]) {
          let key2 = key + '.' + i
          this.errors[key2] = []
          if (!this.labels[key2]) {
            this.labels[key2] = formatter.titlecase(i)
          }
        }
      }
      else {
        this.errors[key] = []
        if (!this.labels[key]) {
          this.labels[key] = formatter.titlecase(key)
        }
      }
    }

  },

  methods: {
    handleErrors(errors) {
      if (errors) {
        this.setErrors(errors)
      }
      else {
        this.clearErrors()
      }
    },

    setErrors(errors) {

      for (let key in this.errors) {
          console.log(key,"key");
        this.errors[key] = errors[key] || []
      }
      console.log(this.errors['userCompany.name'],"err");

      console.log(this.errors['touchPoint.caption'],"errors");
    },

    clearErrors() {
      for (let key in this.errors) {
        this.errors[key] = []
      }
    }
  }
}
