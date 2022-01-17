<template>
    <div class="">
        <!-- Start Row -->
        <div class="row">
            <!-- Start Column To Chat List -->
            <!-- Start Column View Chat -->
            <div class="col-lg-12 ">
                <!-- Start Chat 1 Content -->
                <div>
                    <!-- Start View Chat Content -->
                    <div class="view-chat-content">
                        <div style="overflow-y: scroll; height: 500px" ref="messages">
                            <message v-for="message in messages" :message="message" style=""
                                     :key="'message-'+message.id"/>
                        </div>
                        <div class="clearfix"></div>
                        <send-box :chat="chat" @sendMessage="sendMessage"/>
                    </div><!-- End View Chat Content -->
                </div><!-- End Chat 1 Content -->
            </div><!-- End Column View Chat -->
        </div><!-- End Row -->
    </div>
</template>
<script>
import SendBox from "./send-box";
import Message from "./message";
export default {
    name: "chat",
    components: {Message, SendBox},
    props: ['chat'],
    data() {
        return {
            messages: [],
        }
    },
    created() {
        this.getMessages();
        Echo.channel('chat-' + this.chat).listen('.NewMessageEvent', e => {
            console.log('tet')
            this.messages.push(e.message);
        });
    },
    updated() {
        this.scrollDown();
    },
    methods: {
        scrollDown() {
            var container = this.$refs.messages;
            container.scrollTop = container.scrollHeight;
        },
        getMessages() {
            const res = axios.get('', {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }).then((resp) => {
                this.messages = resp.data.messages.reverse();
            }).then((resp) => {
                this.scrollDown();
            });
        },
        sendMessage(message) {
            this.messages.push(message);
        }
    }
}
</script>
<style scoped>
</style>
