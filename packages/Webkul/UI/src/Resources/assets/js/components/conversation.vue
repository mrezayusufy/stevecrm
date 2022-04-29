<template>
  <div id="chat">
    <h1>Welcome to the conversation app<span v-if="nameRegistered">, {{ name }}</span>!</h1>
    <p>{{ statusString }}</p>
    <div v-if="!nameRegistered">
      <input @keyup.enter="registerName" v-model="name" placeholder="Enter your name">
      <button @click="registerName">Register name</button>
    </div>
    <div v-if="nameRegistered && !activeConversation && isConnected ">
			<ul v-if="conversations">
				<li v-for="(c, index) in conversations" :key="index">
					<a href="#" @click="activeConversation = c">{{ c.friendlyName }}</a>
				</li>
			</ul>
      <button @click="createConversation">Join chat</button>
    </div>
    <conversation v-if="activeConversation" :active-conversation="activeConversation" :conversations="conversations" :name="name" />
  </div>
</template>

<script>
import {Client as ConversationsClient} from "@twilio/conversations"

import conversation from "./conversation"

export default {
	data() {
		return {
			statusString: "",
			activeConversation: null,
			name: "",
			conversations: [],
			nameRegistered: false,
			isConnected: false,
			token: ""
		}
	},
	methods: {
		initConversationsClient: async function() {
			window.conversationsClient = ConversationsClient
			this.token = await this.getToken(this.name)
			this.conversationsClient = await ConversationsClient.create(this.token)
			this.statusString = "Connecting to Twilio…"

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
			this.conversationsClient.on("conversationJoined", (conversation) => {
				console.info(conversation)
				this.conversations.push(conversation)
			})
		},
		getToken: async function(identity) {
			const response = await fetch(`/token/${identity}`).then((res) => res.json()).catch(e=> e)
			console.log(response)
			const responseJson = response.token
			return responseJson
		},
		registerName: async function() {
			this.nameRegistered = true
			await this.initConversationsClient()
		},
	}
}
</script>

<style scoped>
    ul {
        display: flex;
        flex-flow: column;
        gap: 1rem;
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
