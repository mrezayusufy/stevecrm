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
    <div>
        <h1>Welcome to the Vue chat app<span v-if="nameRegistered">, @{{ name }}</span>!</h1>
        <p>@{{ statusString }}</p>
        <div v-if="!nameRegistered">
            <input @keyup.enter="registerName" v-model="name" placeholder="Enter your name">
            <button @click="registerName">Register name</button>
        </div>
        <div v-else-if="nameRegistered && !activeConversation && isConnected">
            @{{activeConversation.friendlyName}}
            <button @click="createConversation">Join chat</button>
        </div>
        @include("admin::chat.conversation")
        {{-- <Conversation v-if="activeConversation" :active-conversation="activeConversation" :name="name" /> --}}
    </div>
</script>


{{-- <script type="text/javascript" src="{{ asset('vendor/webkul/admin/assets/js/twilio-conversations.min.js') }}"></script> --}}
{{-- <script src="https://media.twiliocdn.com/sdk/js/conversations/releases/1.0.0/twilio-conversations.min.js"
        integrity="sha256-wwGP7TgNRaTpRZj6r7CM/ZPMa/mMj44/QRLQNnQMJjU="
        crossorigin="anonymous"></script> --}}
<script src="https://media.twiliocdn.com/sdk/js/conversations/v2.0/twilio-conversations.min.js"></script>

<script>
    Vue.component('chat-component',
    {
        template: "#chat-template",
        data: function () {
            return {
                statusString: "",
                activeConversation: null,
                name: "",
                nameRegistered: false,
                isConnected: false,
                conversationsClient: "",
                conversations: [],
                selectedConversation: "",
                messages: [],
            }
        },
        mounted() {
            this.initConversationsClient();
        },
        methods: {
            initConversationsClient: async function() {
                const token = await this.getToken(this.name)
                this.conversationsClient = new Twilio.Conversations.Client(token);
                this.statusString = "Connecting to Twilio…"
                this.activeConversation = await this.conversationsClient.on("conversationJoined", (conversation) => {
                    this.conversations.push(conversation);
                    this.name = conversation.friendlyName;
                    return conversation;
                })
                console.log(this.activeConversation);
                this.conversationsClient.on("connectionStateChanged", (state) => {
                    switch (state) {
                        case "connected":
                            this.statusString = "You are connected."
                            this.isConnected = true
                            break
                        case "disconnecting":
                            this.statusString = "Disconnecting from Twilio…"
                            break
                        case "disconnected":
                            this.statusString = "Disconnected."
                            break
                        case "denied":
                            this.statusString = "Failed to connect."
                            break
                    }
                })
            },
            getToken: async  function(identity) {
                let response;
                await axios.get("{{ route('admin.chat.get.token', 'steve')}}").then((res) => response = res.data)
                return response.token
            },
            registerName: async function() {
                this.nameRegistered = true
                await this.initConversationsClient()
            },
            createConversation: async function() {
                // Ensure User1 and User2 have an open client session
                try {
                    await this.conversationsClient.getUser("User1")
                    await this.conversationsClient.getUser("User2")
                } catch {
                    console.error("Waiting for User1 and User2 client sessions")
                    return
                }
                // Try to create a new conversation and add User1 and User2
                // If it already exists, join instead
                try {
                    const newConversation = await this.conversationsClient.createConversation({uniqueName: "chat"})
                    const joinedConversation = await newConversation.join().catch(err => console.log(err))
                    await joinedConversation.add("User1").catch(err => console.log("error: ", err))
                    await joinedConversation.add("User2").catch(err => console.log("error: ", err))
                    this.activeConversation = joinedConversation
                } catch {
                    this.activeConversation = await (this.conversationsClient.getConversationByUniqueName("chat"))
                }
            }
        }
    })
</script>

@endpush
