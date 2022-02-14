<template>
    <form action="" class="chat-form" v-on:submit.prevent="sendMessage">
        <div class="chatform-content">
           <!--  <button class="sendt-this">ثصثص
                <i class="flaticon-next"></i>
            </button> -->
            <label class="filelabel">
                <i class="fa fa-paperclip">
                </i>
                <span class="title">

                </span>
                <input class="FileUpload1" id="FileInput" @change="uploadFile" accept=".mp4,.mp3,.jpeg" name="booking_attachment"
                       type="file"/>
            </label>
            <button class="chat-submit" type="submit"> <i class="fas fa-paper-plane"></i></button>
            <input type="text"  v-model="message" placeholder="اكتب رسالتك" class="chat-input-text">

        </div>
    </form>
</template>

<script>
import Swal from "sweetalert2";

export default {
    name: "send-box",
    props: ['chat']
    , data() {
        return {
            message: ''
        }
    },
    methods: {
        uploadFile(event) {
            console.log(event.target.files);

            //image/jpeg
            let types = {
                "image/jpeg": 'image',
                'video/mp4': 'video',
                'audio/mpeg': 'voice'
            }
            let file = event.target.files[0];
            if (typeof types[file['type']] === 'undefined') {
                Swal.fire({
                    text: "عفوا الملف غير مدعوم !",
                    icon: 'error',
                    timer: 2000,
                })
            }
            let inputs = new FormData();
            inputs.append('attachment', file);
            inputs.append('type', types[file['type']]);
            inputs.append('_method', 'PUT');
            inputs.append('message', 'مرفق');
            this.sendData(inputs);
        },
        sendMessage() {
            let data = {
                message: this.message,
                "_method": 'PUT',
                type:'message'
            };
            this.sendData(data);
        },
        sendData(data) {
            axios.post('/accounting/chats/' + this.chat, data).then((resp) => {
                let data = resp.data;
                if (data.status) {
                    Swal.fire({
                        text: data.data.text,
                        icon: 'success',
                        timer: 2000,
                    })
                    this.$emit('sendMessage', data.data.message)

                } else {
                    Swal.fire({
                        text: data.msg,
                        icon: 'error',
                        timer: 2000,
                    })
                }
                this.message = '';
            })
        }
    }
}
</script>

<style scoped>

</style>
