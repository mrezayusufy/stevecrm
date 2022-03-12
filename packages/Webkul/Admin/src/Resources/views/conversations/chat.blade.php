@include("admin::conversations.style")

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
        <div id="search" class="d-flex flex-row">
            <input type="text" placeholder="Search contacts..." />
            <label class="p-3 m-1 d-flex flex-row align-items-center"><i class="mdi mdi-24px mdi-magnify" aria-hidden="true"></i></label>
        </div>
        <div id="contacts">
            <ul class="list-unstyled">
                <li class="contact">
                    <div class="align-items-center d-flex mx-3 position-relative w-75">
                        <div class="bg-light btn-circle me-2 p-3 rounded-pill"><i class="mdi mdi-account"></i></div>
                        <div class="meta w-100">
                            <p class="m-0 name">Louis Litt</p>
                            <p class="m-0 preview text-truncate">You just got LITT up, Mike.</p>
                        </div>
                    </div>
                </li>
                <li class="contact active">
                    <div class="align-items-center d-flex mx-3 position-relative w-75">
                        <div class="bg-light btn-circle me-2 p-3 rounded-pill"><i class="mdi mdi-account"></i></div>
                        <div class="meta w-100">
                            <p class="m-0 name">Harvey Specter</p>
                            <p class="m-0 preview text-truncate">Wrong. You take the gun, or you pull out a bigger one.
                                Or, you
                                call their bluff. Or, you do any one of a hundred and forty six other things.</p>
                        </div>
                    </div>
                </li>
                <li class="contact">
                    <div class="align-items-center d-flex mx-3 position-relative w-75 ">
                        <div class="bg-light btn-circle me-2 p-3 rounded-pill"><i class="mdi mdi-account"></i></div>
                        <div class="meta w-100">
                            <p class="m-0 name">Rachel Zane</p>
                            <p class="m-0 preview text-truncate">I was thinking that we could have chicken tonight,
                                sounds good?
                            </p>
                        </div>
                    </div>
                </li>
                <li class="contact">
                    <div class="align-items-center d-flex mx-3 position-relative w-75">
                        <div class="bg-light btn-circle me-2 p-3 rounded-pill"><i class="mdi mdi-account"></i></div>
                        <div class="meta w-100">
                            <p class="m-0 name">Donna Paulsen</p>
                            <p class="m-0 preview text-truncate">Mike, I know everything! I'm Donna..</p>
                        </div>
                    </div>
                </li>
                <li class="contact">
                    <div class="align-items-center d-flex mx-3 position-relative w-75 text-truncate">
                        <div class="bg-light btn-circle me-2 p-3 rounded-pill"><i class="mdi mdi-account"></i></div>
                        <div class="meta w-100">
                            <p class="m-0 name">Jessica Pearson</p>
                            <p class="m-0 preview text-truncate">Have you finished the draft on the Hinsenburg deal?</p>
                        </div>
                    </div>
                </li>
                <li class="contact">
                    <div class="align-items-center d-flex mx-3 position-relative w-75">
                        <div class="bg-light btn-circle me-2 p-3 rounded-pill"><i class="mdi mdi-account"></i></div>
                        <div class="meta w-100">
                            <p class="m-0 name">Harold Gunderson</p>
                            <p class="m-0 preview text-truncate">Thanks Mike! :)</p>
                        </div>
                    </div>
                </li>
                <li class="contact">
                    <div class="align-items-center d-flex mx-3 position-relative w-75">
                        <div class="bg-light btn-circle me-2 p-3 rounded-pill"><i class="mdi mdi-account"></i></div>
                        <div class="meta w-100">
                            <p class="m-0 name">Daniel Hardman</p>
                            <p class="m-0 preview text-truncate">We'll meet again, Mike. Tell Jessica I said 'Hi'.</p>
                        </div>
                    </div>
                </li>
                <li class="contact">
                    <div class="align-items-center d-flex mx-3 position-relative w-75">
                        <div class="bg-light btn-circle me-2 p-3 rounded-pill"><i class="mdi mdi-account"></i></div>
                        <div class="meta w-100">
                            <p class="m-0 name">Katrina Bennett</p>
                            <p class="m-0 preview text-truncate">I've sent you the files for the Garrett trial.</p>
                        </div>
                    </div>
                </li>
                <li class="contact">
                    <div class="align-items-center d-flex mx-3 position-relative w-75">
                        <div class="bg-light btn-circle me-2 p-3 rounded-pill"><i class="mdi mdi-account"></i></div>
                        <div class="meta w-100">
                            <p class="m-0 name">Charles Forstman</p>
                            <p class="m-0 preview text-truncate">Mike, this isn't over.</p>
                        </div>
                    </div>
                </li>
                <li class="contact">
                    <div class="align-items-center d-flex mx-3 position-relative w-75">
                        <div class="bg-light btn-circle me-2 p-3 rounded-pill"><i class="mdi mdi-account"></i></div>
                        <div class="meta w-100">
                            <p class="m-0 name">Jonathan Sidwell</p>
                            <p class="m-0 preview text-truncate"><span>You:</span> That's bullshit. This deal is solid.
                            </p>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="content col border-start">
        <div class="contact-profile align-items-center contact-profile d-flex px-3">
            <div class="bg-white btn-circle me-2 p-3 rounded-pill"><i class="mdi mdi-account"></i></div>
            <p class="m-0">Harvey Specter</p>
        </div>
        <div class="messages">
            <ul class="list-unstyled">
                <li class="sent">
                    <img src="http://emilcarlsson.se/assets/mikeross.png" alt="" />
                    <p>How the hell am I supposed to get a jury to believe you when I am not even sure that I do?!</p>
                </li>
                <li class="replies">

                    <p>When you're backed against the wall, break the god damn thing down.</p>
                </li>
                <li class="replies">
                    <img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
                    <p>Excuses don't win championships.</p>
                </li>
                <li class="sent">
                    <img src="http://emilcarlsson.se/assets/mikeross.png" alt="" />
                    <p>Oh yeah, did Michael Jordan tell you that?</p>
                </li>
                <li class="replies">
                    <img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
                    <p>No, I told him that.</p>
                </li>
                <li class="replies">
                    <img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
                    <p>What are your choices when someone puts a gun to your head?</p>
                </li>
                <li class="sent">
                    <img src="http://emilcarlsson.se/assets/mikeross.png" alt="" />
                    <p>What are you talking about? You do what they say or they shoot you.</p>
                </li>
                <li class="replies">
                    <img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
                    <p>Wrong. You take the gun, or you pull out a bigger one. Or, you call their bluff. Or, you do any
                        one of a hundred and forty six other things.</p>
                </li>
            </ul>
        </div>
        <div class="message-input">
            <div class="wrap d-flex">
                <textarea type="text" placeholder="Write your message..." class="form-control m-2"></textarea>
                <button class="submit btn-circle m-2 p-3"><i class="mdi mdi-send " aria-hidden="true"></i></button>
            </div>
        </div>
    </div>
    <div class="col-3 border-start col-3 d-flex flex-column align-items-center gap">
        <div class="d-flex flex-column align-items-center py-5 px-2 border-bottom w-100">
            <div class="btn-circle bg-light m-2" style="padding: 2rem"><i class="m-5 mdi mdi-48px mdi-account"></i></div>
            <div class="h3">(901) 633-8101</div>
        </div>
        <a href="{{route('admin.leads.create')}}" class="align-content-center align-items-center btn btn-outline-primary d-flex flex-row fs-5 my-2">
            <i class="mdi mdi-plus pe-2"></i>
            Create New Lead
        </a>
    </div>
</div>

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"
        integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
    <script>
        $(".messages").animate({
            scrollTop: $(document).height()
        }, "fast");

        $("#profile-img").click(function() {
            $("#status-options").toggleClass("active");
        });

        $(".expand-button").click(function() {
            $("#profile").toggleClass("expanded");
            $("#contacts").toggleClass("expanded");
        });

        $("#status-options ul li").click(function() {
            $("#profile-img").removeClass();
            $("#status-online").removeClass("active");
            $("#status-away").removeClass("active");
            $("#status-busy").removeClass("active");
            $("#status-offline").removeClass("active");
            $(this).addClass("active");

            if ($("#status-online").hasClass("active")) {
                $("#profile-img").addClass("online");
            } else if ($("#status-away").hasClass("active")) {
                $("#profile-img").addClass("away");
            } else if ($("#status-busy").hasClass("active")) {
                $("#profile-img").addClass("busy");
            } else if ($("#status-offline").hasClass("active")) {
                $("#profile-img").addClass("offline");
            } else {
                $("#profile-img").removeClass();
            };

            $("#status-options").removeClass("active");
        });

        function newMessage() {
            message = $(".message-input input").val();
            if ($.trim(message) == '') {
                return false;
            }
            $('<li class="sent"><img src="http://emilcarlsson.se/assets/mikeross.png" alt="" /><p>' + message + '</p></li>')
                .appendTo($('.messages ul'));
            $('.message-input input').val(null);
            $('.contact.active .preview').html('<span>You: </span>' + message);
            $(".messages").animate({
                scrollTop: $(document).height()
            }, "fast");
        };

        $('.submit').click(function() {
            newMessage();
        });

        $(window).on('keydown', function(e) {
            if (e.which == 13) {
                newMessage();
                return false;
            }
        });
    </script>
@endpush
