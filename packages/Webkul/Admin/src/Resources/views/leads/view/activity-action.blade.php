{!! view_render_event('admin.leads.view.informations.activity_actions.before', ['lead' => $lead]) !!}

<activity-action-component></activity-action-component>

{!! view_render_event('admin.leads.view.informations.activity_actions.after', ['lead' => $lead]) !!}

@push('scripts')

    <script type="text/x-template" id="activity-action-component-template">
        <tabs>
                {!! view_render_event('admin.leads.view.informations.activity_actions.note.before', ['lead' => $lead]) !!}

                <tab name="{{ __('admin::app.leads.note') }}" :selected="true">
                    <form
                        action="{{ route('admin.activities.store') }}"
                        method="post"
                        data-vv-scope="note-form"
                        @submit.prevent="onSubmit($event, 'note-form')"
                    >

                        <input type="hidden" name="type" value="note">

                        <input type="hidden" name="lead_id" value="{{ $lead->id }}">

                        @csrf()

                        <div class="form-group" :class="[errors.has('note-form.comment') ? 'has-error' : '']">
                            <label for="comment" class="required form-label">{{ __('admin::app.leads.note') }}</label>

                            <textarea
                                name="comment"
                                class="form-control"
                                id="note-comment"
                                v-validate="'required'"
                                data-vv-as="&quot;{{ __('admin::app.leads.note') }}&quot;">
                                {{ old('comment') }}
                            </textarea>

                            <span class="control-error" v-if="errors.has('note-form.comment')">
                                @{{ errors.first('note-form.comment') }}
                            </span>
                        </div>

                        <button type="submit" class="btn btn-md btn-primary">
                            {{ __('admin::app.leads.save') }}
                        </button>

                    </form>
                </tab>

                {!! view_render_event('admin.leads.view.informations.activity_actions.note.after', ['lead' => $lead]) !!}


                {!! view_render_event('admin.leads.view.informations.activity_actions.activity.before', ['lead' => $lead]) !!}

                @if (bouncer()->hasPermission('activities.create'))
                    <tab name="{{ __('admin::app.leads.activity') }}">
                        <form action="{{ route('admin.activities.store') }}" method="post" data-vv-scope="activity-form"
                            @submit.prevent="checkIfOverlapping($event, 'activity-form')">
                
                            <input type="hidden" name="lead_id" value="{{ $lead->id }}">
                
                            @csrf()
                
                            <div class="form-group" :class="[errors.has('activity-form.title') ? 'has-error' : '']">
                                <label for="title" class="required form-label">@{{selectType === 'message' || selectType === 'call' ? 'Phone' : 'Title'}}</label>
                                <input name="title" 
                                    v-model="setPhone"
                                    class="form-control" 
                                    v-validate="'required'"
                                    data-vv-as="&quot;{{ __('admin::app.activities.title-control') }}&quot;" />
                                <span class="control-error" v-if="errors.has('activity-form.title')">
                                    @{{ errors.first('activity-form.title') }}
                                </span>
                            </div>
                            <div class="form-group" :class="[errors.has('activity-form.type') ? 'has-error' : '']">
                                <label for="type" class="required form-label">{{ __('admin::app.leads.type') }}</label>
                
                                <select v-model="selectType" name="type" class="form-control" v-validate="'required'"
                                    data-vv-as="&quot;{{ __('admin::app.leads.type') }}&quot;">
                                    <option value="" disabled selected>{{ __('admin::app.leads.select-type') }}</option>
                                    <option value="call">{{ __('admin::app.leads.call') }}</option>
                                    <option value="message">{{ __('admin::app.leads.message') }}</option>
                                    <option value="meeting">{{ __('admin::app.leads.meeting') }}</option>
                                    <option value="lunch">{{ __('admin::app.leads.lunch') }}</option>
                                </select>
                
                                <span class="control-error" v-if="errors.has('activity-form.type')">
                                    @{{ errors.first('activity-form.type') }}
                                </span>
                            </div>
                
                            <div class="form-group date"
                                :class="[errors.has('activity-form.schedule_from') || errors.has('activity-form.schedule_to') ? 'has-error' : '']">
                                <label for="schedule_from" class="required form-label">{{ __('admin::app.leads.schedule') }}</label>
                
                                <div class="input-group">
                                    <datetime>
                                        <input type="text" name="schedule_from" class="form-control" v-model="schedule_from"
                                            ref="schedule_from" placeholder="{{ __('admin::app.leads.from') }}"
                                            v-validate="'required|date_format:yyyy-MM-dd HH:mm:ss|after:{{ \Carbon\Carbon::now()->format('Y-m-d H:i:s') }}'"
                                            data-vv-as="&quot;{{ __('admin::app.leads.from') }}&quot;" />
                
                                        <span class="control-error" v-if="errors.has('activity-form.schedule_from')">
                                            @{{ errors.first('activity-form.schedule_from') }}
                                        </span>
                                    </datetime>
                
                                    <datetime>
                                        <input type="text" name="schedule_to" class="form-control" v-model="schedule_to" ref="schedule_to"
                                            placeholder="{{ __('admin::app.leads.to') }}"
                                            v-validate="'required|date_format:yyyy-MM-dd HH:mm:ss|after:schedule_from'"
                                            data-vv-as="&quot;{{ __('admin::app.leads.to') }}&quot;" />
                
                                        <span class="control-error" v-if="errors.has('activity-form.schedule_to')">
                                            @{{ errors.first('activity-form.schedule_to') }}
                                        </span>
                                    </datetime>
                                </div>
                            </div>
                
                            <div class="form-group">
                                <label class="form-label" for="location">{{ __('admin::app.leads.location') }}</label>                
                                <input name="location" class="form-control" />
                            </div>
                
                            <div class="form-group video-conference">
                            </div>
                
                            <div class="form-group">
                                <label class="form-label" for="comment">{{ __('admin::app.leads.description') }}</label>
                
                                <textarea class="form-control" id="activity-comment" name="comment">{{ old('comment') }}</textarea>
                            </div>
                
                            <div class="form-group">
                                <label class="form-label" for="participants">{{ __('admin::app.leads.participants') }}</label>                
                                <div class="lookup-control">
                                    <div class="form-group" style="margin-bottom: 0">
                                        <input type="text" class="form-control" v-model="search_term" autocomplete="off"
                                            placeholder="{{ __('admin::app.leads.participant-info') }}" v-on:keyup="search">
                
                                        <div class="lookup-results grouped" v-if="search_term.length">
                                            <label>{{ __('admin::app.leads.users') }}</label>
                
                                            <ul>
                                                <li v-for='(participant, index) in searched_participants.users'
                                                    @click="addParticipant('users', participant)">
                                                    <span>@{{ participant.name }}</span>
                                                </li>
                
                                                <li v-if='! searched_participants.users.length && search_term.length && ! is_searching'>
                                                    <span>{{ __('admin::app.common.no-result-found') }}</span>
                                                </li>
                                            </ul>
                
                                            <label>{{ __('admin::app.leads.persons') }}</label>
                
                                            <ul>
                                                <li v-for='(participant, index) in searched_participants.persons'
                                                    @click="addParticipant('persons', participant)">
                                                    <span>@{{ participant.name }}</span>
                                                </li>
                
                                                <li
                                                    v-if='! searched_participants.persons.length && search_term.length && ! is_searching'>
                                                    <span>{{ __('admin::app.common.no-result-found') }}</span>
                                                </li>
                                            </ul>
                                        </div>
                
                                        <i class="icon loader-active-icon" v-if="is_searching"></i>
                                    </div>
                
                                    <div class="lookup-selected-options">
                                        <span class="badge badge-sm badge-pill badge-secondary-outline users"
                                            v-for='(participant, index) in participants.users'>
                                            <input type="hidden" name="participants[users][]" :value="participant.id" />
                                            @{{ participant.name }}
                                            <i class="icon close-icon" @click="removeParticipant('users', participant)"></i>
                                        </span>
                
                                        <span class="badge badge-sm badge-pill badge-warning-outline persons"
                                            v-for='(participant, index) in participants.persons'>
                                            <input type="hidden" name="participants[persons][]" :value="participant.id" />
                                            @{{ participant.name }}
                                            <i class="icon close-icon" @click="removeParticipant('persons', participant)"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                
                            <button type="submit" class="btn btn-md btn-primary">
                                {{ __('admin::app.leads.save') }}
                            </button>
                
                        </form>
                    </tab>
                @endif

                {!! view_render_event('admin.leads.view.informations.activity_actions.activity.after', ['lead' => $lead]) !!}
                

                {!! view_render_event('admin.leads.view.informations.activity_actions.message.before', ['lead' => $lead]) !!}
                @if (bouncer()->hasPermission('mail.compose'))
                    <tab name="{{ __('admin::app.leads.message') }}">
                        <form action="{{ route('admin.message.send', $lead->phone) }}" method="post" enctype="multipart/form-data"
                            data-vv-scope="email-form" @submit.prevent="onSubmit($event, 'email-form')">
                            @csrf()
                            <div class="form-group">
                                <label for="body" class="form-label">Message</label>
                                <textarea name="body" class="form-control" id="body" v-validate="'required'"></textarea>
                            </div>
                            <button type="submit" class="btn btn-md btn-primary">
                                {{ __('admin::app.leads.send') }}
                            </button>
                        </form>
                    </tab>
                @endif
                {!! view_render_event('admin.leads.view.informations.activity_actions.message.after', ['lead' => $lead]) !!}


                {!! view_render_event('admin.leads.view.informations.activity_actions.file.before', ['lead' => $lead]) !!}

                <tab name="{{ __('admin::app.leads.file') }}">
                    <form
                        action="{{ route('admin.activities.file_upload') }}"
                        method="post"
                        enctype="multipart/form-data"
                        data-vv-scope="file-form"
                        @submit.prevent="onSubmit($event, 'file-form')"
                    >

                        <input type="hidden" name="type" value="file">

                        <input type="hidden" name="lead_id" value="{{ $lead->id }}">

                        @csrf()

                        <div class="form-group">
                            <label for="name" class="form-label">{{ __('admin::app.leads.name') }}</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="comment">{{ __('admin::app.leads.description') }}</label>

                            <textarea class="form-control" id="files-comment" name="comment">{{ old('comment') }}</textarea>
                        </div>

                        <div class="form-group" :class="[errors.has('file-form.file') ? 'has-error' : '']">
                            <label for="file" class="required form-label">{{ __('admin::app.leads.file') }}</label>

                            <input
                                type="file"
                                name="file"
                                class="form-control"
                                id="file"
                                v-validate="'required'"
                                data-vv-as="&quot;{{ __('admin::app.leads.file') }}&quot;"
                            >

                            <span class="control-error" v-if="errors.has('file-form.file')">
                                @{{ errors.first('file-form.file') }}
                            </span>
                        </div>

                        <button type="submit" class="btn btn-md btn-primary">
                            {{ __('admin::app.leads.upload') }}
                        </button>

                    </form>
                </tab>

                {!! view_render_event('admin.leads.view.informations.activity_actions.file.after', ['lead' => $lead]) !!}


                {!! view_render_event('admin.leads.view.informations.activity_actions.quote.before', ['lead' => $lead]) !!}

                @if (bouncer()->hasPermission('quotes.create'))
                    <tab name="{{ __('admin::app.leads.quote') }}">
                
                        <a href="{{ route('admin.quotes.create', $lead->id) }}"
                            class="btn btn-primary">{{ __('admin::app.leads.create-quote') }}</a>
                
                    </tab>
                @endif

                {!! view_render_event('admin.leads.view.informations.activity_actions.quote.after', ['lead' => $lead]) !!}
            </tabs>
        </script>

    <script>
        Vue.component('activity-action-component', {

            template: '#activity-action-component-template',

            props: ['data'],

            inject: ['$validator'],

            data: function() {
                return {
                    show_cc: false,

                    show_bcc: false,

                    schedule_from: null,

                    schedule_to: null,

                    search_term: '',

                    is_searching: false,

                    searched_participants: {
                        'users': [],

                        'persons': []
                    },

                    participants: {
                        'users': [],

                        'persons': []
                    },

                    selectType: "",
                    phone:  @json($lead->phone),
                }
            },
            computed: {
                setPhone: function() {
                    return this.selectType === 'message' || this.selectType === 'call' ? this.phone : '';
                }
            },
            mounted: function() {
                var self = this;

                tinymce.init({
                    selector: 'textarea#reply',

                    height: 200,

                    width: "100%",

                    plugins: 'image imagetools media wordcount save fullscreen code table lists link hr',

                    toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor link hr | alignleft aligncenter alignright alignjustify | numlist bullist outdent indent  | removeformat | code | table',

                    image_advtab: true,

                    setup: function(editor) {
                        editor.on('keyUp', function() {
                            self.$validator.validate('email-form.reply', this.getContent());
                        });
                    }
                });
            },

            methods: {
                onSubmit: function(e, formScope) {
                    this.$root.onSubmit(e, formScope);
                },

                search: debounce(function() {
                    this.is_searching = true;

                    if (this.search_term.length < 2) {
                        this.searched_participants = {
                            'users': [],

                            'persons': []
                        };

                        this.is_searching = false;

                        return;
                    }

                    this.$http.get("{{ route('admin.activities.search_participants') }}", {
                            params: {
                                query: this.search_term
                            }
                        })
                        .then(response => {
                            var self = this;

                            ['users', 'persons'].forEach(function(userType) {
                                self.participants[userType].forEach(function(addedUser) {

                                    response.data[userType].forEach(function(user,
                                        index) {
                                        if (user.id == addedUser.id) {
                                            response.data[userType].splice(
                                                index, 1);
                                        }
                                    });

                                });
                            });

                            this.searched_participants = response.data;

                            this.is_searching = false;
                        })
                        .catch(error => {
                            this.is_searching = false;
                        })
                }, 500),

                addParticipant: function(type, participant) {
                    this.search_term = '';

                    this.searched_participants = {
                        'users': [],

                        'persons': []
                    };

                    this.participants[type].push(participant);
                },

                removeParticipant: function(type, participant) {
                    const index = this.participants[type].indexOf(participant);

                    Vue.delete(this.participants[type], index);
                },

                checkIfOverlapping: function(e, formScope) {
                    var self = this;

                    this.$validator.validateAll(formScope).then(function(result) {
                        if (result) {
                            self.$http.post(`{{ route('admin.activities.check_overlapping') }}`, {
                                    schedule_from: self.schedule_from,
                                    schedule_to: self.schedule_to,
                                    participants: self.participants,
                                }).then(response => {
                                    if (!response.data.overlapping) {
                                        self.$root.onSubmit(e, formScope);
                                    } else {
                                        if (confirm(
                                                "{{ __('admin::app.activities.duration-overlapping') }}"
                                                )) {
                                            self.$root.onSubmit(e, formScope);
                                        }
                                    }
                                })
                                .catch(error => {});
                        }
                    });
                }
            }
        });
    </script>

@endpush
