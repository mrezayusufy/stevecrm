@push("scripts")
<style scoped>
    .conversation-container {
        margin: 0 auto;
        max-width: 400px;
        height: calc(100vh - 20ch) ;
        padding: 0 20px;
        border: 3px solid #f1f1f1;
        overflow: scroll;
    }

    .bubble-container {
        text-align: left;
    }

    .bubble {
        border: 2px solid #f1f1f1;
        background-color: #fdfbfa;
        border-radius: 5px;
        padding: 10px;
        margin: 10px 0;
        width: 230px;
        float: right;
    }

    .myMessage .bubble {
        background-color: #abf1ea;
        border: 2px solid #87E0D7;
        float: left;
    }

    .name {
        padding-right: 8px;
        font-size: 11px;
    }

    ::-webkit-scrollbar {
        width: 10px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    ::-webkit-scrollbar-thumb {
        background: #888;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

</style>
<script type="text/x-template" id="conversation-template">
    <div class="d-flex flex-column">
        <div class="conversation-container">
            <div
                v-for="(message, index) in messages" :key="index"
                class="bubble-container"
                :class="{ myMessage: message?.author === message?.identity }"
            >
                <div class="bubble">
                    <div class="name">@{{ message?.author }}:</div>
                    <div class="message">@{{ message?.body }}</div>
                </div>
            </div>
        </div>
        <div class="input-container">
            <input @keyup.enter="sendMessage" v-model="messageText" placeholder="Enter your message">
            <button @click="sendMessage" class="btn btn-success">Send message</button>
        </div>
    </div>
</script>
<script>
    Vue.component('Conversation', {
        template: "#conversation-template",
        props: ["activeConversation","name"],
        data: function(){
            return {
                messages: [],
                messageText: "",
                isSignedInUser: false,
                conversationProxy: this.activeConversation,
                loading: 'initializing',
                sid: this.activeConversation.sid
            }
        },
        mounted: function(){
            this.getMessages()
        },
        methods: {
            getMessages: async function() {
                this.loading = "loading";
                await fetch("/admin/chat/messages/" + this.sid)
                .then((response) => response.json())
                .then((data) => {
                    this.messages = data;
                    console.info("messages: ",data)
                    this.loading = 'ready';
                })
            },
            sendMessage: async function() {
                const formdata = new FormData();
                formdata.append("body", this.messageText);
                const request = {
                    body: this.messageText,
                };
                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                await fetch( "{{route('admin.chat.send.message', '')}}/"+this.sid , {
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    method: 'POST',
                    body: JSON.stringify(request),
                })
                .then((response) => response.json())
                .then((data) => console.log(data));
            },
        }
    })
</script>
@endpush
