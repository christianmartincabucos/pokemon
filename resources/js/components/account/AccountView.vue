<template>
  <div class="account-view">
    <div class="container">
      <h4>Welcome, {{this.loggedInEmail}}!</h4>
      <p class="text-primary">Double-click form to register and/or update information.</p>
      <div class="row shadow-lg">
        <div class="col rounded-start form-side">
          <h5 class="heading text-white">User Information</h5>

            <!-- form -->
            <div class="form" @dblclick="this.editable = true">
            <div class="mb-3">
              <label class="form-label text-white">First Name</label>
              <input
                type="text"
                id="first_name"
                :disabled="this.editable==false"
                class="form-control"
                :class="this.editable ?  '': 'editableTrue'"
                v-model="this.form.first_name"
              />
            </div>
            <div class="mb-3">
              <label class="form-label text-white">Last Name</label>
              <input
                type="text"
                id="last_name"
                :disabled="this.editable==false"
                class="form-control"
                :class="this.editable ?  '': 'editableTrue'"
                v-model="this.form.last_name"
              />
            </div>
            <div class="mb-3">
              <label class="form-label text-white">Birthdate</label>
              <input
                type="date"
                id="birthday"
                :disabled="this.editable==false"
                class="form-control"
                :class="this.editable ?  '': 'editableTrue'"
                v-model="this.form.birthday"
              />
            </div>
            <button :class="this.storeStatus === 'toCreate' ? 'btn btn-success text-white' : 'btn btn-info text-white'" :onClick="this.storeStatus === 'toCreate' ? createDetails : updateDetails" v-if="this.editable">
              {{
                this.storeStatus === 'toCreate'?
                "Save":
                "Update"
              }}

            </button>
          </div><!--end .form -->


        </div>

        <div class="col rounded-end image-side"></div>
      </div>
    </div>
  </div>
</template>

<script>
export default {

  data() {
    return{
      storeStatus: "",
      form:{

        id: 0,
        first_name: "",
        last_name: "",
        birthday: ""
      },
      editable: false,
      userLogged: [],
    }
  },

  methods: {

    updateDetails(){
      axios.post('api/users/update/'+ this.form.id, this.form)
      .then(response => {
        if(response.status == 200){
          alert("Information Updated");
          this.editable = true

        }
      }).catch(err => {
        console.log(err)
      });
     }

  },
  mounted() {
    this.userLogged = JSON.parse(localStorage.getItem("user_logged"));
    this.form.first_name = this.userLogged.first_name;
    this.form.last_name = this.userLogged.last_name;
    this.form.birthday = this.userLogged.birthday;
    this.form.id = this.userLogged.id;
    this.userLogged ? this.editable = true:false;
  },
};
</script>
<style scoped>
  .account-view {
    padding-bottom: 100px;
    font-family: "Poppins";

  }
  .form {
    width: 50%;
    display: block;
    margin: auto;
  }
  .form-side,
  .image-side {
    height: 600px;
  }
  .form-side {
    background-image: linear-gradient(-225deg, #f77361 0%, #e1341e 75%);
  }
  .image-side {
    background-image: url("http://localhost:8000/image/21003.jpg");
    background-size: cover;
    background-repeat: no-repeat;
    background-position-x: center;
  }

  .heading {
    margin: 30px;
  }
  .container {
    padding-left: 100px;
    padding-right: 100px;
    padding-bottom: 50px;
  }
  .editableTrue{
    background-color: transparent;
    border: 0px;
    font-weight: bold;
    color: #61E5F7;
  }
  .editableBG{
    background-color: azure;
  }
</style>