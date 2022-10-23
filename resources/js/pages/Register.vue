<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="alert alert-danger" role="alert" v-if="form.error !== null">
          {{ error }}
        </div>

        <div class="card">
          <div class="card-header bg-info text-white">Register</div>
          <div class="card-body">
            <form>
              <div class="form-group row">
                <label for="first_name" class="col-sm-4 col-form-label text-md-right"
                  >First Name</label
                >
                <div class="col-md-6">
                  <input
                    id="first_name"
                    type="text"
                    class="form-control"
                    v-model="form.first_name"
                    required
                    autofocus
                    autocomplete="off"
                  />
                </div>
              </div>

              <div class="form-group row">
                <label for="last_name" class="col-sm-4 col-form-label text-md-right"
                  >Last Name</label
                >
                <div class="col-md-6">
                  <input
                    id="last_name"
                    type="text"
                    class="form-control"
                    v-model="form.last_name"
                    required
                    autofocus
                    autocomplete="off"
                  />
                </div>
              </div>

              <div class="form-group row">
                <label for="birthday" class="col-sm-4 col-form-label text-md-right"
                  >Birthday</label
                >
                <div class="col-md-6">
                  <input
                    id="birthday"
                    type="date"
                    class="form-control"
                    v-model="form.birthday"
                    required
                    autofocus
                    autocomplete="off"
                  />
                </div>
              </div>

              <div class="form-group row">
                <label for="email" class="col-sm-4 col-form-label text-md-right"
                  >E-Mail</label
                >
                <div class="col-md-6">
                  <input
                    id="email"
                    type="email"
                    class="form-control"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="off"
                  />
                </div>
              </div>

              <div class="form-group row">
                <label
                  for="password"
                  class="col-md-4 col-form-label text-md-right"
                  >Password</label
                >
                <div class="col-md-6">
                  <input
                    id="password"
                    type="password"
                    class="form-control"
                    v-model="form.password"
                    required
                    autocomplete="off"
                  />
                </div>
              </div>

              <div class="form-group row">
                <label
                  for="password"
                  class="col-md-4 col-form-label text-md-right"
                  >Confirm Password</label
                >
                <div class="col-md-6">
                  <input
                    id="password"
                    type="password"
                    class="form-control"
                    v-model="form.confirm_password"
                    required
                    autocomplete="off"
                  />
                </div>
              </div>

              <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                  <button
                    type="submit"
                    class="btn btn-info text-white"
                    @click="handleSubmit"
                  >
                    Register
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form:{
        first_name: "",
        last_name: "",
        birthday: "",
        email: "",
        password: "",
        confirm_password: "",
        error: null,
      }
    };
  },
  methods: {
    handleSubmit(e) {
      e.preventDefault();
      if (this.form.password ===  this.form.confirm_password) {
        axios
          .post("api/register", {
            first_name: this.form.first_name,
            last_name: this.form.last_name,
            birthday: this.form.birthday,
            email: this.form.email,
            password: this.form.password,
          })
          .then((response) => {
            if (response.data.message) {
              //window.location.href = "/login"
              this.$router.push({ name: "Login" });
            } else {
              this.error = response.data.message;
            }
          })
          .catch(function (error) {
            console.error("Register error: ", error);
          });
      }
    },
  },
};
</script>
<style scoped>
.form-group {
  margin-bottom: 5px;
}
</style>
