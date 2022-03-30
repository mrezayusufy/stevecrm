@push('scripts')
    <script type="text/x-template" id="contact-component-template">
        <div class="contact-controls d-flex flex-row flex-wrap gap-3">
            {{-- person firstname --}}
            <div class="form-group col-5" :class="[errors.has('{!! $formScope ?? '' !!}person[firstname]') ? 'has-error' : '']">
                <label for="person[firstname]" class="required">{{ __('admin::app.leads.firstname') }}</label>
                {{-- person firstname --}}
                <input
                    type="text"
                    name="person[firstname]"
                    class="control "
                    id="person[firstname]"
                    v-model="person.firstname"
                    autocomplete="off"
                    placeholder="{{ __('admin::app.common.start-typing') }}"
                    v-validate="'required'"
                    data-vv-as="&quot;{{ __('admin::app.leads.firstname') }}&quot;"
                    v-on:keyup="search"
                />
                {{-- person id --}}
                <input
                    type="hidden"
                    name="person[id]"
                    class="form-control"
                    v-model="person.id"
                    v-validate="'required'"
                    data-vv-as="&quot;{{ __('admin::app.leads.firstname') }}&quot;"
                    v-if="person.id"
                />
                {{-- add person --}}
                <div class="lookup-results" v-if="state == ''">
                    <ul>
                        <li v-for='(person, index) in persons' @click="addPerson(person)">
                            <span>@{{ person.firstname }}</span>
                        </li>

                        <li v-if="! persons.length && person['firstname'].length && ! is_searching">
                            <span>{{ __('admin::app.common.no-result-found') }}</span>
                        </li>

                        <li class="action" v-if="person['firstname'].length && ! is_searching" @click="addAsNew()">
                            <span>
                                + {{ __('admin::app.common.add-as') }}
                            </span>
                        </li>
                    </ul>
                </div>

                <span class="control-error" v-if="errors.has('{!! $formScope ?? '' !!}person[firstname]')">
                    @{{ errors.first('{!! $formScope ?? '' !!}person[firstname]') }}
                </span>
            </div>
            {{-- person lastname --}}
            <div class="form-group col-5" :class="[errors.has('{!! $formScope ?? '' !!}person[lastname]') ? 'has-error' : '']">
                <label for="person[lastname]" >{{ __('admin::app.leads.lastname') }}</label>
                <input
                    type="text"
                    name="person[lastname]"
                    class="control "
                    id="person[lastname]"
                    v-model="person.lastname"
                    autocomplete="off"
                    data-vv-as="&quot;{{ __('admin::app.leads.lastname') }}&quot;"
                />
                <span class="control-error" v-if="errors.has('{!! $formScope ?? '' !!}person[lastname]')">
                    @{{ errors.first('{!! $formScope ?? '' !!}person[lastname]') }}
                </span>
            </div>
            {{-- person birthday --}}
            <div class="form-group col-5" :class="[errors.has('{!! $formScope ?? '' !!}person[birthday]') ? 'has-error' : '']">
                <label for="person[birthday]" >{{ __('admin::app.leads.birthday') }}</label>
                <input
                    type="date"
                    name="person[birthday]"
                    class="control "
                    id="person[birthday]"
                    v-model="person.birthday"
                    autocomplete="off"
                    data-vv-as="&quot;{{ __('admin::app.leads.birthday') }}&quot;"
                />
                <span class="control-error" v-if="errors.has('{!! $formScope ?? '' !!}person[birthday]')">
                    @{{ errors.first('{!! $formScope ?? '' !!}person[birthday]') }}
                </span>
            </div>
            {{-- person expected_close_date --}}
            <div class="form-group col-5" :class="[errors.has('{!! $formScope ?? '' !!}person[expected_close_date]') ? 'has-error' : '']">
                <label for="person[expected_close_date]" >{{ __('admin::app.leads.expected_close_date') }}</label>
                <input
                    type="date"
                    name="person[expected_close_date]"
                    class="control "
                    id="person[expected_close_date]"
                    v-model="person.expected_close_date"
                    autocomplete="off"
                    data-vv-as="&quot;{{ __('admin::app.leads.expected_close_date') }}&quot;"
                />
                <span class="control-error" v-if="errors.has('{!! $formScope ?? '' !!}person[expected_close_date]')">
                    @{{ errors.first('{!! $formScope ?? '' !!}person[expected_close_date]') }}
                </span>
            </div>
            {{-- person next_expiration_date --}}
            <div class="form-group col-5" :class="[errors.has('{!! $formScope ?? '' !!}person[next_expiration_date]') ? 'has-error' : '']">
                <label for="person[next_expiration_date]" >{{ __('admin::app.leads.next_expiration_date') }}</label>
                <input
                    type="date"
                    name="person[next_expiration_date]"
                    class="control "
                    id="person[next_expiration_date]"
                    v-model="person.next_expiration_date"
                    autocomplete="off"
                    data-vv-as="&quot;{{ __('admin::app.leads.next_expiration_date') }}&quot;"
                />
                <span class="control-error" v-if="errors.has('{!! $formScope ?? '' !!}person[next_expiration_date]')">
                    @{{ errors.first('{!! $formScope ?? '' !!}person[next_expiration_date]') }}
                </span>
            </div>
            {{-- person address --}}
            <div class="form-group address col-12">
                <label for="person[address]">{{ __('admin::app.leads.address') }}</label>

                @include('admin::common.custom-attributes.edit.address', ['formScope' => $formScope ?? ''])

                <address-component
                    :attribute="{'code': 'person[address]', 'name': 'Address'}"
                    :data="person.address"
                ></address-component>
            </div>
            {{-- person emails --}}
            <div class="form-group email col-5">
                <label for="person[emails]" class="required">{{ __('admin::app.leads.email') }}</label>

                @include('admin::common.custom-attributes.edit.email', ['formScope' => $formScope ?? ''])

                <email-component
                    :attribute="{'code': 'person[emails]', 'name': 'Email'}"
                    :data="person.emails"
                    validations="required|email"
                ></email-component>
            </div>
            {{-- person contact numbers --}}
            <div class="form-group contact-numbers col-5 ">
                <label for="person[contact_numbers]">{{ __('admin::app.leads.contact-numbers') }}</label>

                @include('admin::common.custom-attributes.edit.phone', ['formScope' => $formScope ?? ''])

                <phone-component
                    :attribute="{'code': 'person[contact_numbers]', 'name': 'Contact Numbers'}"
                    :data="person.contact_numbers"
                ></phone-component>
            </div>

        </div>
    </script>

    <script>
        Vue.component('contact-component', {

            template: '#contact-component-template',

            props: ['data'],

            inject: ['$validator'],

            data: function () {
                return {
                    is_searching: false,

                    state: this.data ? 'old': '',

                    person: this.data ? this.data : {
                        'firstname': '',
                    },

                    persons: [],
                }
            },
            mounted(){
                console.log(this.person)
            },
            methods: {
                search: debounce(function () {
                    this.state = '';

                    this.person = {
                        'firstname': this.person['firstname']
                    };

                    this.is_searching = true;

                    if (this.person['firstname'].length < 2) {
                        this.persons = [];

                        this.is_searching = false;

                        return;
                    }

                    var self = this;

                    this.$http.get("{{ route('admin.contacts.persons.search') }}", {params: {query: this.person['firstname']}})
                        .then (function(response) {
                            self.persons = response.data;

                            self.is_searching = false;
                        })
                        .catch (function (error) {
                            self.is_searching = false;
                        })
                }, 500),

                addPerson: function(result) {
                    this.state = 'old';

                    this.person = result;
                },

                addAsNew: function() {
                    this.state = 'new';
                }
            }
        });
    </script>
@endpush
