@include('admin::conversations.style')
<div id="frame" class="d-flex flex-row border">
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
        <div id="contacts">
            <ul class="list-unstyled">
                <div id="loading">loading...</div>
            </ul>
        </div>
    </div>
    <div class="content col border-start bg-white">
        <div class="contact-profile align-items-center contact-profile d-flex px-3">
            <div class="bg-white btn-circle me-2 p-3 rounded-pill"><i class="mdi mdi-account mdi-24px"></i></div>
            <p class="m-0 username"></p>
        </div>
        <div class="messages">
            <ul class="list-unstyled overflow-auto" id="messages">

            </ul>
        </div>
        <div class="message-input">
            <div class="wrap d-flex">
                <textarea type="text" placeholder="Write your message..." class="form-control m-2"></textarea>
                <button type="submit" class="submit btn-circle m-2 p-3"><i class="mdi mdi-send "
                        aria-hidden="true"></i></button>
            </div>
        </div>
    </div>
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

@push('scripts')
    <script>
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
    </script>
    {{-- message component --}}
    <script type="text/x-template" id="message-template">
        <div>@{{ msg }}</div>
                        </script>
    <script>
        Vue.component("message", {
            data: function() {
                return {
                    msg: "hello"
                }
            },
            template: "#message-template"
        })
    </script>
    {{-- contact component --}}
    <script type="text/x-template" id="contact-template">
        <li>
                                    @{{ contact.name }}
                                </li>
                        </script>
    <script>
        Vue.component("contact-item", {
            props: ['contact'],
            template: "#contact-template"
        })
    </script>
    {{-- end --}}
@endpush
