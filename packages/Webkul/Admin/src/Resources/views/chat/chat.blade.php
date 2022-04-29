@push("scripts")
<style scoped>
    ul {
    list-style-type: none;
    padding: 0;
    }

    li {
    display: inline-block;
    margin: 0 10px;
    }

    a {
    color: #42b983;
    }
</style>
<script type="text/x-template" id="chat-template">
    <section>
        <section class="d-flex flex-column col-5 gap-3">
            <div v-if="alert">@{{alert}}</div>
            <div class="row">
                <label for="friendlyName" class="form-label">friendly Name:</label>
                <input type="text" id="friendlyName" class="form-control" v-model="friendlyName" />
            </div>
            <div class="row">
                <label for="participant" class="form-label">phone Number:</label>
                <input type="text" id="participant" class="form-control" v-model="participant" />
            </div>
            <div class="d-flex flex-start"><button @click="createConversation" class="btn btn-success">Create</button></div>
        </section>

        <div v-if="newConversation">
            <div class="px-2">&#128100;</div> @{{ newConversation.friendlyName}} <div class="px-2">&#x1F4DE;</div> @{{ newConversation.participant }} ( @{{ newConversation.sid }} )
        </div>
        <h1>Welcome to the chat app<span v-if="nameRegistered">, @{{ name }}</span>!</h1>
        <p v-if="statusString === 'loading'">
            <spinner-meter></spinner-meter>
        </p>

        <div v-for="(c, index) in conversations" :key="index">
            <a href="#" @click="joinConversation(c)">@{{ c.friendlyName }}</a>
             (<small>@{{ c.sid }}</small>)
        </div>
        @include("admin::chat.conversation")
        <Conversation v-if="activeConversation" :active-conversation="activeConversation" :name="name" />
    </section>
</script>


<script>

    Vue.component('chat-component',
    {
        template: "#chat-template",
        data: function () {
            return {
                statusString: "loading...",
                activeConversation: null,
                name: "",
                friendlyName: "",
                participant: "",
                nameRegistered: false,
                isConnected: false,
                conversationsClient: "",
                conversations: [],
                newConversation: null,
                selectedConversation: "",
                messages: [],
                alert: null,
            }
        },
        mounted() {
            this.initConversationsClient();
            this.$store.dispatch('fetchConversations');
            this.$store.getters.conversations
        },
        methods: {
            initConversationsClient: async function() {
                this.statusString = "loading";
                this.conversations = await fetch("/admin/chat/conversations/fetch")
                .then((response) => response.json())
                .then((data) => data.conversations)
                this.statusString = "success";

            },
            getToken: async  function(identity) {
                let response;
                await this.$http.get("{{ route('admin.chat.get.token', 'steve')}}").then((res) => response = res.data)
                return response.token
            },
            registerName: async function() {
                this.nameRegistered = true
                await this.initConversationsClient()
            },
            joinConversation: function(conversation) {
                this.nameRegistered = true;
                this.activeConversation = conversation;
                this.name = conversation.friendlyName;
            },
            createConversation: async function() {
                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const data = JSON.stringify({
                        "friendlyName": this.friendlyName,
                        "participant": this.participant
                    });
                await this.$http.post( "{{route('admin.create.conversation')}}" , data)
                .then(response=> this.newConversation = response.data)
                .catch(error => { alert(error) })
            },
        },
        computed: {
            convesations() {
                return this.$store.getters.conversations;
            }
        }
    })
</script>

@endpush
