<template>
  <ul>
    <li v-for="user in users">{{user.name}}</li>
  </ul>
</template>

<script>
  import Vue from 'vue'
  export default {
    channel: 'chat',
    echo: {
      'MensagemEvent': (payload, vm) => {
        console.log('new message from team', payload);
      }
    },
    mounted(){
      this.$echo.join(`chat`)
        .here((users) => {

          Vue.set(this, 'users', users)
        }).joining((user) => {

        this.users.push(user)

      }).leaving((user) => {
          var users = this.users
        users.forEach(function(userunit, index){
            if(user.id === userunit.id){
                users.splice(index, 1)
            }
        })
      })

    },
    name: 'Presence',
   data (){
        return {
            users:[]
        }
   }
  }
</script>
