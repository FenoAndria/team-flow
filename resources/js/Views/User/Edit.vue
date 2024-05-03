<template>
  <div>
    User Profile edit
    <div class="" v-if="loadingUser"><span>LOADING...</span></div>
    <div v-else>
      <div v-if="user && user.profil">
        <form @submit="handleUpdateProfil">
          <div>
            <label for="">Name</label>
            <input type="text" v-model="user.profil.name" />
          </div>
          <div>
            <label for="">Birth date</label>
            <input type="date" v-model="user.profil.birth_date" />
          </div>
          <div>
            <label for="">Gender</label>
            <select name="gender" v-model="user.profil.gender" class="block">
              <option value="male" :checked="true">Male</option>
              <option value="female">Female</option>
            </select>
          </div>
          <div>
            <label for="">Bio</label>
            <input type="text" v-model="user.profil.bio" />
          </div>
          <button>Save</button>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
import { computed, onMounted } from "@vue/runtime-core";
import { useStore } from "vuex";
import { getUser, updateUser } from "../../Services/UserServices";
import { useRouter } from "vue-router";
export default {
  setup(props) {
    const store = useStore();
    const router = useRouter();
    const loadingUser = computed(() => store.getters.loadingUser);
    const user = computed(() => store.getters.user);
    const handleUpdateProfil = async (e) => {
      e.preventDefault();
      await updateUser(user.value.profil);
    };
    onMounted(async () => {
      await getUser();
    });
    return {
      loadingUser,
      user,
      handleUpdateProfil,
    };
  },
};
</script>