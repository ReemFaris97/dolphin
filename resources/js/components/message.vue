<template>
    <!--
        <div v-if="message.sender.type.toLowerCase()==type" class="another-user-box" style="
      justify-content: flex-end;
    ">
            <div v-if="message.sender.name" class="incoming_msg_img"> {{ message.sender.name }}</div>
            <div class="received_msg">
                <div class="received_with_msg">
                    <p class="text" style="
        background-color: #a9cf69;
        color: black;
    ">{{ message.message }}</p>
                    <span class="time_date">{{ created_at }}</span></div>
            </div>
        </div>
    -->
<div>
    <div v-if="message.is_sender" class="another-user-box">

        <div v-if="message.user.name" class="incoming_msg_img"> {{ message.user.name }}</div>
        <div class="received_msg">
            <div class="received_with_msg">
                <p v-if="message.text" class="text my-msg" >{{ message.text }}</p>
                <span class="time_date">{{ created_at }}</span></div>
        </div>
    </div>

    <div v-else class="another-user-box-">

        <div class="content-msg-mobile">
            <div  class="another-user-box-mobile">
                <div class="my-msg-mobile my-media-mobile">
                    <div>
                        <div v-if="message.type=='voice'" class="my-msg my-media">
                            <vue-plyr>
                                <audio controls crossorigin playsinline>
                                    <source
                                        :src="message.attachment"
                                        type="audio/mp3"
                                    />
                                </audio>
                            </vue-plyr>
                        </div>
                        <div v-else-if="message.type=='video'" style="width: 300px;height: 300px" class="my-msg my-media">
                            <vue-plyr >
                                <video
                                    controls
                                    crossorigin
                                    playsinline
                                    :data-poster="message.thumbnail"
                                >
                                    <source
                                        size="240"
                                        :src="message.attachment"
                                        type="video/mp4"
                                    />

                                </video>
                            </vue-plyr>

                        </div>
                        <div v-else-if="message.type=='image'" class="my-msg my-media">
                            <div>
                                <a :href="message.attachment" target="_blank"><img :src="message.attachment" class="img-lg img-preview img-responsive" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div  class="incoming_msg_img"> test</div>
                <div class="received_msg">
                    <div class="received_with_msg">
                        <p v-if="message.text" class="text my-msg-mobile">{{ message.text }}</p>
                        <div class="align-left"><span class="time_date">{{ created_at }}</span></div>
                    </div>
                </div>
            </div>
        </div>
        </div>

</div>
</template>

<script>
import * as dayjs from 'dayjs'
// import VuePlyr from 'vue-plyr'

export default {
    components: {
        // VuePlyr
    },
    name: "message",
    props: {

        message: {
            type: Object,
            required: true
        }
    },
    data() {
        return {}
    },
    created() {
    },
    computed: {
        created_at: function () {
            return dayjs(this.message.created_at).format('YYYY-MM-DD HH:mm::ss')
        }
    },

}
</script>

<style scoped>

</style>
