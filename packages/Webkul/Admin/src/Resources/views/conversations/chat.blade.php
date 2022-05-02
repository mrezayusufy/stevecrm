@include('admin::conversations.style')

<div id="frame" class="border">
    <conversations></conversations>
    {{-- contact list --}}
    {{-- <div id="sidepanel" class="col-4 d-none">
        <div id="profile d-none">
            <div class="wrap d-none">
                <p class="m-0">Mike Ross</p>
                <div id="status-options">
                    <ul class="list-unstyled">
                        <li id="status-online" class="active"><span class="status-circle"></span>
                            <p>Online</p>
                        </li>
                        <li id="status-away"><span class="status-circle"></span>
                            <p>Away</p>
                        </li>
                        <li id="status-busy"><span class="status-circle"></span>
                            <p>Busy</p>
                        </li>
                        <li id="status-offline"><span class="status-circle"></span>
                            <p>Offline</p>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
        <div id="search" class="d-flex flex-row bg-white">
            <input type="text" placeholder="Search contacts..." class="bg-white" />
            <label class="p-3 m-1 d-flex flex-row align-items-center"><i class="mdi mdi-24px mdi-magnify"
                    aria-hidden="true"></i></label>
        </div> --}}
        {{-- contact list --}}
        {{-- <div id="contacts">
            <ul class="list-unstyled">
                <div id="loading">loading...</div>
            </ul>
        </div> --}}
    {{-- </div> --}}
    {{-- <div class="content col border-start bg-white d-none">
        <div class="contact-profile align-items-center contact-profile d-flex px-3">
            <div class="bg-white btn-circle me-2 p-3 rounded-pill"><i class="mdi mdi-account mdi-24px"></i></div>
            <p class="m-0 username"></p>
        </div>
        <div class="messages">
            <ul class="list-unstyled overflow-auto" id="messages"></ul>
        </div>
        <div class="message-input">
            <div class="wrap d-flex">
                <textarea type="text" placeholder="Write your message..." class="form-control m-2"></textarea>
                <button type="submit" class="submit btn-circle m-2 p-3"><i class="mdi mdi-send "
                        aria-hidden="true"></i></button>
            </div>
        </div>
    </div> --}}
    {{-- <div class="col-3 border-start col-3 d-flex flex-column align-items-center gap bg-white">
        <div class="d-flex flex-column align-items-center py-5 px-2 border-bottom w-100">
            <div class="btn-circle bg-light m-2" style="padding: 2rem">
                <i class="m-5 mdi mdi-48px mdi-account-outline"></i>
            </div>
            <div class="h3 username"></div>
        </div>
        <a href="{{ route('admin.leads.create') }}"
            class="align-content-center align-items-center btn btn-outline-primary d-flex flex-row fs-5 my-2">
            <i class="mdi mdi-plus pe-2"></i>
            Create New Lead
        </a>
    </div> --}}
</div>
@section('dialog')
    <create-contact></create-contact>
@endsection
@push('scripts')

{{-- <script>
    Date.prototype.monthNames = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December",
    ];
    Date.prototype.getMonthName = function() {
        return this.monthNames[this.getMonth()];
    };
    Date.prototype.getShortMonthName = function() {
        return this.getMonthName().substr(0, 3);
    };
    $(document).ready(function() {
        var $loading = $("#loading").hide();
        $(".write_msg").val("");
        let conversations = [];
        let loading = false;
        let conversationSid;

        function fetchMessage(sid) {
            $.ajax({
                url: "/conversation/action.php?q=msg&sid=" + sid,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    console.info(data);
                },
                error: function(e) {
                    console.error(e);
                },
            });
        }

        // $.ajax({
        //     url: "{{ route('admin.chat.fetch.conversations') }}",
        //     type: "GET",
        //     dataType: "json",
        //     beforeSend: function(xhr) {
        //         loading = true;
        //         $loading.show();
        //     },
        //     success: function(data) {
        //         conversations = data.conversations;
        //         $.each(conversations, function(i) {
        //             $("#alert").append(i.friendlyName);
        //         });
        //     },
        //     error: function(e) {
        //         $("#alert").append(e);
        //     },
        //     complete: function() {
        //         loading = false;
        //         $loading.hide();
        //         $.each(conversations, function(item) {
        //             $("#alert").append(item.friendlyName);
        //         });
        //     },
        // });
        $.getJSON("{{ route('admin.chat.fetch.conversations') }}", function(data) {
            conversations = data.conversations;
            $.each(conversations, function(index, c) {

                $("#contacts ul").append( //html
                    `
                    <li class="contact bg-white ${c.sid === conversationSid ? 'active' : ''}" id="${index}" value="${c.sid}">
                        <div class="align-items-center d-flex mx-3 position-relative w-75">
                            <div class="bg-light btn-circle me-2 p-3 rounded-pill"><i class="mdi mdi-account mdi-24px"></i>
                            </div>
                            <div class="meta w-100">
                                <p class="m-0 name">${c.friendlyName}</p>
                                <p class="m-0 preview text-truncate"></p>
                            </div>
                        </div>
                    </li>
                    `
                );

                $(".contact").click(function() {
                    var current = $(this).attr("value");
                    $(".username").append(c.friendlyName)
                    conversationSid = current;
                    console.log(current)
                    $.getJSON(
                        "{{ route('admin.chat.fetch.messages', '') }}/" + current,
                        function(data) {
                            var messages = data;
                            $.each(messages, function(index, m) {
                                const d = moment(m.created_at.date);
                                let month = d.format("MMMM");
                                let day = d.format("D");
                                let time = d.format("LT");
                                if (m.author === m.identity)
                                    $(".messages ul").append( //html
                                        `
                                        <li class="replies d-flex">
                                            <div class="ms-auto">
                                                <div class="bg-gray btn-circle float-right ms-2 text-white"><i
                                                        class="mdi mdi-24px mdi-account-outline "></i></div>
                                                <div class="d-flex flex-column">
                                                    <p class="m-0">${m.body}</p>
                                                    <span class="fs-xs"> ${time} | ${month} ${day}</span>
                                                </div>
                                            </div>
                                        </li>
                                        `
                                    );
                                else
                                    $(".messages ul").append( //html
                                        `
                                        <li class="sent d-flex">
                                            <div>
                                                <div class="bg-gray btn-circle float-left me-2 text-white"><i
                                                        class="mdi mdi-24px mdi-account-outline "></i></div>
                                                <div class="d-flex flex-column">
                                                    <p class="m-0">${m.body}</p>
                                                <span class="fs-xs"> ${time} | ${month} ${day}</span>
                                                </div>
                                            </div>
                                        </li>
                                        `
                                    );
                            });
                        }
                    );
                    $("#messages").scrollTop(100000);
                });
            });
        });
        $(".message-input button").click(function() {
            var msg = $(".message-input textarea").val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('admin.chat.send.message', '') }}/" + conversationSid,
                type: "POST",
                data: {
                    body: msg,
                },
                dataType: "json",
                beforeSend: function(xhr) {
                    loading = true;
                },
                success: function(data) {
                    const response = data.response;
                    console.log("response", response);
                    const d = moment(response.created_at.date);
                    let month = d.format("MMMM");
                    let day = d.format("D");
                    let time = d.format("LT");
                    $(".messages ul").append( //html
                        `
                    <li class="replies d-flex">
                        <div class="ms-auto">
                            <div class="bg-gray btn-circle float-right ms-2 text-white"><i
                                    class="mdi mdi-24px mdi-account-outline "></i></div>
                            <div class="d-flex flex-column">
                                <p class="m-0">${response.body}</p>
                                <span class="fs-xs"> ${time} | ${month} ${day}</span>
                            </div>
                        </div>
                    </li>
                    `
                    );
                },
                error: function(e) {
                    console.log(e);
                },
                complete: function() {
                    $(".message-input textarea").val("");
                    loading = false;
                },
            });
        });
        setInterval(() => {
            $(".messages").scrollTop(100000);
            if (conversationSid) {
                // fetchMessage(conversationSid)
            }
        }, 1000);
    });
</script> --}}
{{-- modal --}}
<script type="text/x-template" id="create-contact-template">
    <dialog ref="dialog" class="position-absolute top-0 bg-dark position-relative w-100 h-100" style="z-index: 100000; --bs-bg-opacity: 0.3">
        <div class="d-flex w-100 h-100 justify-content-center align-items-center">
            <div class="m-auto rounded-3 p-4 d-flex flex-column gap-2 bg-white shadow-md" style="width: 30rem">
                <h4>create contact</h4>
                <div>
                    <label for="friendlyName" class="form-label">Name</label>
                    <input id="friendlyName" v-model="friendlyName" placeholder="type name" class="form-control"/>
                </div>
                <div>
                    <label for="participant" class="form-label">Number</label>
                    <input id="participant" v-model="participant" placeholder="type number" class="form-control"/>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-light" @click="close">cancel</button>
                    <button type="submit" @click="save" class="btn btn-primary bg-primary">save</button>
                </div>
            </div>
        </div>
    </dialog>
</script>
<script>
    Vue.component("create-contact",{
        template: "#create-contact-template",
        data: function(){
            return {
                participant: "",
                friendlyName: ""
            }
        },
        methods: {
            save: async function(){
                const form = new FormData();
                form.append('friendlyName', this.friendlyName)
                form.append('participant', this.participant);
                await this.$http.post("{{ route('admin.create.conversation') }}", form)
                    then((res) => console.log(res))
            },
            close: function(){
                    const dialog = document.querySelector("dialog");
                    if(dialog)
                        dialog.close();
                },
        }
    })
</script>
{{-- message --}}
    <script type="text/x-template" id="message-template">
        <li class="d-flex gap-2" :class="type">
            <div class="bg-gray btn-circle float-right text-white"><i
                    class="mdi mdi-24px mdi-account-outline "></i></div>
            <div class="d-flex flex-column">
                <p class="m-0">@{{ message.body }}</p>
                <span class="fs-xs">@{{ time }} | @{{ month }} @{{ day }}</span>
            </div>
        </li>
    </script>
    <script>
        Vue.component('message',{
            template: "#message-template",
            props: ['message'],
            computed:{
                type: function() {
                    return this.message.author === this.message.identity ? 'replies flex-row-reverse ms-auto' : 'sent';
                },
                time: function(date){
                    const d = moment(this.message.created_at.date);
                    return d.format("LT");
                },
                month: function(){
                    const d = moment(this.message.created_at.date);
                    return d.format("MMMM");
                },
                day: function(){
                    const d = moment(this.message.created_at.date);
                    return d.format("D");
                },
            }
        })
    </script>
    {{-- messages component --}}
    <script type="text/x-template" id="messages-template">
        <div class="content col border-start bg-white d-flex flex-column">

            <div class="contact-profile align-items-center contact-profile d-flex px-3" v-if="!loading">
                <div class="bg-white btn-circle me-2 p-3 rounded-pill"><i class="mdi mdi-account mdi-24px"></i></div>
                <p class="m-0 username">@{{ data.friendlyName }}</p>
            </div>
            <div class="spinner-border text-primary m-auto " v-if="loading" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <div class="messages" ref="messagesList">
                <ul class="list-unstyled overflow-auto" id="messages" v-if="!loading" >
                    <message v-for="message in messages" :key="message.sid" :message="message"></message>
                </ul>
            </div>
            <div class="message-input d-flex" v-if="!loading">
                <div class="wrap d-flex p-2 gap-2 bg-white w-100">
                    <textarea type="text" v-model="body" placeholder="Write your message..." class="form-control"></textarea>
                    <button @click="sendMessage(data.sid)" aria-label="send" class="submit btn-circle p-3">
                        <i class="mdi mdi-send"></i>
                    </button>
                </div>
            </div>
        </div>
    </script>
    <script>
        Vue.component("messages", {
            template: "#messages-template",
            props: ['data'],
            data: function() {
                return {
                    messages: [],
                    loading: true,
                    body: "",
                }
            },
            mounted(){
                setInterval(() => this.getMessages(this.data.sid), 5000)
                this.scrollTop()
            },
            methods: {
                getMessages: async function(sid){
                    this.loading = true;
                    console.log(this.loading)
                    await this.$http.get("{{ route('admin.chat.fetch.messages','') }}/"+sid)
                        .then((res) => this.messages = res.data.messages)
                        .catch((e) => console.log(e))
                        .finally(this.stopLoading())
                    console.log(this.loading)
                    this.scrollTop();
                },
                sendMessage: async function(sid){
                    const body = this.body;
                    this.loading = true
                    await this.$http.post("{{ route('admin.chat.send.message', '') }}/" + sid, {
                        body: body
                    }).then((res) => this.getMessages(sid))
                    .catch((e) => console.log(e))
                    .finally(() => { this.stopLoading(); this.body = ''})
                },
                stopLoading: function(){
                    this.loading = false;
                },
                scrollTop: function(){
                    if(this.loading === false){
                        var messageList = this.$refs.messagesList;
                        var msg = document.querySelector(".messages")

                        if(msg || messageList){
                            // messageList.scrollTop = messageList.scrollHeight
                            msg.scrollTop = msg.scrollHeight;
                            // messageList.scrollIntoView({ behavior: "smooth", block: "end" });
                            console.log(msg)
                        }
                    }
                    // $("#messages").scrollTop(100000);
                }
            }
        });
    </script>

    {{-- contact component --}}
    <script type="text/x-template" id="contacts-template">
        <div class="d-flex col-9">
            <div id="sidepanel" class="col-4">
                <div id="profile d-none">
                    <div class="wrap d-none">
                        <p class="m-0">Mike Ross</p>
                        <div id="status-options">
                            <ul class="list-unstyled">
                                <li id="status-online" class="active"><span class="status-circle"></span>
                                    <p>Online</p>
                                </li>
                                <li id="status-away"><span class="status-circle"></span>
                                    <p>Away</p>
                                </li>
                                <li id="status-busy"><span class="status-circle"></span>
                                    <p>Busy</p>
                                </li>
                                <li id="status-offline"><span class="status-circle"></span>
                                    <p>Offline</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div id="search" class="d-flex flex-row bg-white">
                    <input type="text" placeholder="Search contacts..." class="bg-white" />
                    <label class="p-3 m-1 d-flex flex-row align-items-center"><i class="mdi mdi-24px mdi-magnify"
                            aria-hidden="true"></i></label>
                </div>
                {{-- * contact list --}}
                <div id="contacts" class="position-relative">
                    <ul class="list-unstyled">
                        <li v-for="c in data" :key="c.sid" @click="contact = c" type="button" :class="{ 'active' : c.sid === contact.sid }" class="contact bg-white">
                            <div class="align-items-center d-flex mx-3 position-relative w-75">
                                <div class="bg-light btn-circle me-2 p-3 rounded-pill"><i class="mdi mdi-account mdi-24px"></i>
                                </div>
                                <div class="meta w-100">
                                    <p class="m-0 name">@{{ c.friendlyName }}</p>
                                    <p class="m-0 preview text-truncate"></p>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <button @click="openDialog" class="position-absolute m-3 bottom-0 end-0 p-3 rounded-pill btn-circle fs-3 btn btn-primary">
                        <i class="mdi mdi-plus p-1"></i>
                    </button>
                </div>
            </div>
            {{-- * messages and send message --}}
            <template v-if="contact">
                <messages :data="contact" ></messages>
            </template>
        </div>
    </script>

    <script>
        Vue.component("contacts", {
            template: "#contacts-template",
            props: ['data'],
            data: function(){
                return {
                    loading: false,
                    messages: [],
                    contact: false,
                }
            },
            methods: {
                getMessages: async function(sid){
                    this.loading = true;
                    await this.$http.get("{{ route('admin.chat.fetch.messages','') }}/"+sid)
                        .then((res) => this.messages = res.data)
                        .catch((e) => console.log(e))
                        .finally(() => this.loading = false)
                },
                openDialog: function(){
                    const dialog = document.querySelector("dialog");
                    if(dialog)
                        dialog.show();
                },

            }
        })
    </script>
    <script type="text/x-template" id="conversations">
        <div id="frame" class="border d-flex position-relative">
            <div class="spinner-border text-primary m-auto position-absolute top-50 start-50" role="status" v-if="loading">
                <span class="visually-hidden">Loading...</span>
            </div>
            <contacts :data="conversations"></contacts>
            <div class="col-3 border-start col-3 d-flex flex-column align-items-center gap bg-white">
                <div class="d-flex flex-column align-items-center py-5 px-2 border-bottom w-100">
                    <div class="btn-circle bg-light m-2" style="padding: 2rem">
                        <i class="m-5 mdi mdi-48px mdi-account-outline"></i>
                    </div>
                    <div class="h3 username"></div>
                </div>
                <a href="{{ route('admin.leads.create') }}"
                    class="align-content-center align-items-center btn btn-outline-primary d-flex flex-row fs-5 my-2">
                    <i class="mdi mdi-plus pe-2"></i>
                    Create New Lead
                </a>
            </div>
        </div>
    </script>
    <script>
        Vue.component('conversations', {
            template: "#conversations",
            data: function(){
                return {
                    msg: "hello",
                    loading: true,
                    conversations: [],
                    error: "",
                    current: "",
                }
            },
            mounted(){
                this.fetchConversations();
            },
            methods: {
                fetchConversations: async function(){
                    await this.$http.get("{{ route('admin.chat.fetch.conversations') }}")
                            .then((res) => this.conversations = res.data.conversations)
                            .finally(this.stopLoading)
                            .catch((e) => console.log(e))
                },
                stopLoading: function(){
                    this.loading = false;
                },

            }
        });
    </script>
    {{-- end --}}
@endpush
