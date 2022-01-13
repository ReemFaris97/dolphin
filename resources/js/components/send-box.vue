<template>
    <form action="" class="chat-form" v-on:submit.prevent="sendMessage">
        <div class="chatform-content">
            <button class="sendt-this">
                <i class="flaticon-next"></i>
            </button>
            <input type="text"  v-model="message" placeholder="اكتب رسالتك" class="chat-input-text">

        </div>
    </form>
</template>

<script>
import Swal from "sweetalert2";
export default {
    name: "send-box",
    props:['chat']
    ,data(){
        return {
            message:''
        }
    },
    methods:{
        sendMessage(){
           axios.post('/accounting/chats/'+this.chat,{
               message:this.message,
               "_method":'PUT'
           }).then((resp)=>{
             let  data=resp.data;
               if (data.status){
                   Swal.fire({
                       text: data.data.text,
                       icon: 'success',
                       timer:2000,
                   })
                   this.$emit('sendMessage',data.data.message)

               }else{
                   Swal.fire({
                       text: data.msg,
                       icon: 'error',
                       timer:2000,
                   })
               }
               this.message='';
           })
        }
    }
}
</script>

<style scoped>

</style>
