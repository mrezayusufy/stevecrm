@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.dashboard.title') }}
@stop
@section('title')
    {{ __('admin::app.dashboard.title') }}
@stop

@section('content-wrapper')
    <div class="content full-page dashboard">
        {!! view_render_event('admin.dashboard.index.filter.before') !!}

        <selected-cards-filter></selected-cards-filter>

        {!! view_render_event('admin.dashboard.index.filter.after') !!}


        {!! view_render_event('admin.dashboard.index.cards.before') !!}
        <div class="grid grid-columns row-d g-10" style="--columns: repeat(3,1fr);">
            <div class="card grid-column-2 bg-white shadow-sm rounded">
                <div class="card-header flex column p-10 px-20 space-between">
                    <div class="flex row-d space-between py-20 center lh-1">
                        <div>Congrats! STEVE Claire Moser is on pace.</div>
                        <div class="pill bg-light grid column content-center fs-s hidden h-25 shadow-sm" style="padding: 15px 5px;">
                            <div class="bg-primary px-10 p-5 pill lh-1 h-25">Premium</div>
                            <div class="p-5 px-10 lh-1 h-25 text-secondary">Policies</div>
                        </div>
                    </div>
                    <div class="grid column grid-columns g-10 py-10" style="--columns: .5fr 1fr;">
                        <div class="grid row-d g-10 relative">
                            <div class="bg-light p-10 rounded-s hidden relative flex justify-center column">
                                <div class="fs-s py-10 lh-1" style="--p: 5px">STARTED TODAY AT</div>
                                <div class="fs-xxl">$0</div>
                                <div class="absolute right bottom fs-100 o-2" style="right: -20px;"><span class="mdi mdi-star-outline"></span></div>
                            </div>
                            <div class="bg-light p-10 rounded-s hidden relative flex justify-center column">
                                <div class="fs-s py-10 lh-1" style="--p: 5px">SHOULD BE AT</div>
                                <div class="fs-xxl">$0</div>
                                <div class="absolute right bottom fs-100 o-2 " style="right: -20px;"><span class="mdi mdi-bullseye-arrow rotate"></span></div>
                            </div>
                            <div class="bg-gray p-10 rounded-s hidden relative flex justify-center column">
                                <div class="fs-xxl">$0</div>
                                <div class="fs-s py-10 lh-1" style="--p: 5px">GOAL FOR TODAY</div>
                                <div class="absolute right bottom fs-100 o-2" style="right: -20px;"><span class="mdi mdi-bullseye"></span></div>
                            </div>
                        </div>
                        <div class="grid column center relative">
                            <div class="grid all-center ">
                                <div class="flex center content-center grid-area">
                                    <div class="text-center">
                                        <div class="fs-xxl text-gray">STILL NEEDED</div>
                                        <div class="fs-50 lh-1 py-10">$0</div>
                                    </div>
                                </div>
                                <svg height="300" width="300" viewbox="0 0 82 82" class="circle-progress-bar grid-area">
                                    <circle cx="41" cy="41" r="40" stroke-width="2" fill="rgba(0,0,0,0)" />
                                </svg>
                            </div>
                            <div class="absolute right bottom">
                                <ul style="list-style: initial;" class="text-success">
                                    <li>
                                        <div class="fs-s text-gray">ACHIEVE TODAY</div>
                                        <strong class="text-dark">$0</strong>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card grid row-d bg-white shadow-sm rounded p-1 g-10" style="--p:20px;">
                <div class="flex space-between py-10 center">
                    <div>January stats</div>
                    <div class="pill bg-light grid column content-center fs-s hidden h-25 shadow-sm" style="padding: 15px 5px;">
                        <div class="bg-primary px-10 p-5 pill lh-1 h-25">Premium</div>
                        <div class="p-5 px-10 lh-1 h-25 text-secondary">Policies</div>
                    </div>
                </div>
                <div class="bg-light p-10 rounded-s hidden relative flex justify-center column center shadow-inset">
                    <div class="fs-l py-10 lh-1" style="--p: 5px">TRENDING FOR</div>
                    <div class="fs-xxl">$0</div>
                    <div class="fs-xs py-10 lh-1 text-gray">100% GOAL ABOVE OF 0$</div>
                </div>
                <div class="bg-light p-10 py-20 rounded-s hidden relative flex space-between row center">
                    <div class="flex column text-left">
                        <div class="fs-xs py-10 lh-1 bold" style="--p: 5px">VS LAST MONTH</div>
                        <div><span class="fs-xxl">N/A</span> <span class="mdi mdi-arrow-up text-success bg-white pill shadow fs-x square hl-1 p-3"></span></div>
                    </div>
                    <div class="flex column text-right">
                        <div class="fs-xxl text-secondary">$0</div>
                        <div class="fs-xs py-10 lh-1 bold">LAST MONTH</div>
                    </div>
                </div>
                <div class="bg-light p-1 rounded-s hidden relative flex space-between row center shadow-inset" style="--color: #3a7ef2">
                    <div class="flex column text-left">
                        <div class="fs-xs p-1 lh-1 bold" style="--p: 5px;--r:0;--l:0;">CURRENTLY AT</div>
                        <div><span class="fs-xxl lh-1 text-secondary">$0</span></div>
                    </div>
                    <div class="flex column text-right">
                        <div class="fs-xxl lh-1 text-secondary" >$100</div>
                        <div class="fs-xs py-10 lh-1 bold">OF GOAL</div>
                    </div>
                </div>
            </div>
            {{-- business --}}
            <div class="grid-column-2 bg-white shadow-sm rounded p-1" style="--n: 3; --p: 20px;">
                <div class="flex row-d space-between">
                    <select value="write-business" class="p-1 rounded border-gray">
                        <option value="write-business">Write Business</option>
                        <option value="write-business">Write Business</option>
                    </select>
                    <div class="flex row-d g-10">
                        <div class="pill bg-light grid column content-center fs-s hidden h-25 shadow-sm" style="padding: 15px 5px;">
                            <div class="bg-primary px-10 p-5 pill lh-1 h-25">Chart</div>
                            <div class="p-5 px-10 lh-1 h-25 text-secondary">Details</div>
                        </div>
                        <div class="pill bg-light grid column content-center fs-s hidden h-25 shadow-sm" style="padding: 15px 5px;">
                            <div class="bg-primary px-10 p-5 pill lh-1 h-25">Permium $133,957</div>
                            <div class="p-5 px-10 lh-1 h-25 text-secondary">Policies</div>
                        </div>
                    </div>
                </div>
                <div class="grid column grid-columns p-1" style="--p: 0; --t: 10px; --columns: repeat(3,1fr);">
                    <div class="flex column">
                        <h1 class="fs-x">Filters</h1>
                        <div class="grid row-d column g-10 w-1" style="--w: 70%;">
                            <div class="bg-light border-gray p-1 rounded">
                                <p class="m-0 py-10" style="--t:0;">Time Frame</p>
                                <select name="time-frame" id="time-frame" class="border-0 bg-light text-secondary">
                                    <option value="MTD">MDT</option>
                                    <option value="MTD">MDT</option>
                                </select>
                            </div>
                            <div class="bg-light border-gray p-1 rounded">
                                <p class="m-0 py-10" style="--t:0;">All carries</p>
                                <select name="all-carries" id="all-carries" class="border-0 bg-light text-secondary">
                                    <option value="all-carries">All carries</option>
                                    <option value="all-carries">All carries</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="grid-column-2">
                        <div id="chart">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <cards-collection></cards-collection>
        {!! view_render_event('admin.dashboard.index.cards.after') !!}
    </div>
@stop

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        var options = {
        chart: {
            type: 'bar'
        },
        series: [{
            name: 'sales',
            data: [30,40,45,50,49,60,70,91,125]
        }],
        xaxis: {
            categories: [1991,1992,1993,1994,1995,1996,1997, 1998,1999]
        }
        }

        var chart = new ApexCharts(document.querySelector("#chart"), options);

        chart.render();

    </script>
    <script type="text/x-template" id="selected-cards-template">
        {{-- <button type="button" @click="exportDashboard">Export</button> --}}
    </script>

    <script type="text/x-template" id="cards-collection-template">
        <draggable v-model="filteredCards" @change="onRowDrop" class="dashboard-content">

            <div v-for="(filteredCardRow, index) in filteredCards" :key="index">
                <draggable :key="`inner-${index}`" :list="filteredCardRow" class="row-grid-3" handle=".drag-icon" @change="onColumnDrop">
                    <div :class="`card rounded ${card.card_border || ''}`" v-for="(card, cardRowIndex) in filteredCardRow" :key="`row-${index}-${cardRowIndex}`">
                        <template v-if="card.label">

                            <label class="card-header">@{{ card.label }}
                                <div class="icon-container">
                                    <a v-if="card.view_url" :href="card.view_url">
                                        <i class="icon eye-icon"></i>
                                    </a>
                                    <i class="icon drag-icon"></i>
                                </div>
                            </label>
                        </template>

                        <card-component
                            :index="index"
                            :card-type="card.card_type"
                            :class-name="card.data_class"
                            :card-id="card.card_id || ''"
                        ></card-component>
                    </div>
                </draggable>
            </div>
        </draggable>
    </script>

    <script type="text/x-template" id="card-template">
        <div class="db-wg-spinner" v-if="! dataLoaded">
            <spinner-meter></spinner-meter>
        </div>

        <div v-else :class="`card-data ${className || ''}`">
            <bar-chart
                :id="`bar-chart-${cardId}`"
                :data="dataCollection.data"
                v-if="
                    cardType == 'bar_chart'
                    && dataCollection
                "
            ></bar-chart>

            <line-chart
                :id="`line-chart-${cardId}`"
                :data="dataCollection.data"
                v-if="
                    cardType == 'line_chart'
                    && dataCollection
                "
            ></line-chart>

            <template v-else-if="['activities', 'pipelines_bar'].indexOf(cardType) > -1">
                <h3 v-if="dataCollection.header_data">
                    <template v-for="(header_data, index) in dataCollection.header_data">
                        @{{ header_data }}
                    </template>
                </h3>

                <div class="activity bar-data" v-for="(data, index) in dataCollection.data">
                    <span>@{{ data.label }}</span>

                    <div class="bar">
                        <div
                            class="primary"
                            :style="`width: ${data.count ? (data.count * 100) / (dataCollection.total) : 0}%;`"
                        ></div>
                    </div>

                    <span>@{{ `${data.count || 0} / ${(dataCollection.total)}` }}</span>
                </div>
            </template>

            <div class="lead" v-else-if="cardType == 'top_card'" v-for="(data, index) in dataCollection.data">
                <a :href="'{{ route('admin.leads.view') }}/' + data.id">@{{ data.title }}</a>

                <div class="details">
                    <span>@{{ data.amount | toFixed }}</span>
                    <span>@{{ data.created_at | formatDate }}</span>
                    <span>
                        <span
                            class="badge badge-round badge-primary"
                            :class="{'badge-danger': data.statusLabel == 'Lost', 'badge-success': data.statusLabel == 'Won'}"
                        ></span>

                        @{{ data.statusLabel }}
                    </span>
                </div>
            </div>

            <div class="column-container" v-else-if="cardType == 'column-grid-2'" v-for="(data, index) in dataCollection.data">
                <span>@{{ data.count }}</span>
                <span>@{{ data.label }}</span>
            </div>

            <template v-else-if="cardType == 'custom_card'">
                <div class="custom-card">+</div>
                <div class="custom-card">{{ __('admin::app.dashboard.custom_card') }}</div>
            </template>

            <template v-if="! dataCollection || dataCollection.length == 0 || (dataCollection.data && dataCollection.data.length == 0)">
                <div class="custom-card">
                    <i
                        :class="`icon empty-bar-${cardType == 'line_chart' ? 'vertical-': ''}icon`"
                        v-if="cardType == 'bar_chart' || cardType == 'line_chart'"
                    ></i>

                    <img
                        v-else
                        src="{{ asset('vendor/webkul/admin/assets/images/empty-state-icon.svg') }}"
                    />

                    <span>{{ __('admin::app.dashboard.no_record_found') }}</span>
                </div>
            </template>
        </div>
    </script>

    <script type="text/x-template" id="card-filter-template">
        <div class="card-filter-container">
            <div class="toggle-btn dropdown-toggle">
                <span>{{ __('admin::app.dashboard.cards') }}</span>
                <i class="icon arrow-down-icon"></i>
            </div>

            <div class="dropdown-list">
                <div class="dropdown-container">
                    <ul>
                        <template v-if="filterType == 'monthly'">
                            <li>This month</li>
                            <li>Last month</li>
                        </template>

                        <template v-else-if="filterType == 'daily'">
                            <li>Today</li>
                            <li>Yesterday</li>
                        </template>
                    </ul>
                </div>
            </div>
        </div>
    </script>

    <script>
        Vue.component('selected-cards-filter', {
            template: '#selected-cards-template',

            data: function () {
                return {
                    columns: [],
                    showCardOptions: false,
                }
            },

            created: function () {
                EventBus.$on('cardsLoaded', cards => {
                    this.columns = cards;
                });
            },

            methods: {
                updateCards: function (dateRange) {
                    this.$http.post(`{{ route('admin.api.dashboard.cards.update') }}`, {
                        cards: this.columns
                    }).then(response => {
                        this.cards = response.data;

                        this.showCardOptions = false;
                    })
                    .catch(error => {});
                },

                updateCardData: function (dateRange) {
                    EventBus.$emit('updateDateRange', dateRange);
                },

                exportDashboard: function () {
                    $('.dashboard-content').addClass('print');

                    setTimeout(() => {
                        window.print();

                        $('.dashboard-content').removeClass('print');
                    });
                }
            }
        });

        Vue.component('cards-collection', {
            template: "#cards-collection-template",

            data: function () {
                return {
                    cards: [],
                    filteredCards: [],
                }
            },

            created: function () {
                this.getDashboardCards();
            },

            mounted: function () {
                EventBus.$on('updateDateRange', dates => {
                    this.updateURI(dates.datesRange, "date-range");
                });
            },

            methods: {
                getDashboardCards: function () {
                    this.$http.get(`{{ route('admin.api.dashboard.cards.index') }}`)
                        .then(response => {
                            this.cards = response.data;

                            this.filteredCards = this.filterCards();

                            EventBus.$emit('cardsLoaded', this.cards);
                        })
                        .catch(error => {});
                },

                updateURI: function (value, key) {
                    var newURL = `${window.location.origin}${window.location.pathname}?${key}=${value}`;

                    window.history.pushState({path: newURL}, '', newURL);
                },

                filterCards: function () {
                    let filteredCardsChunks = [];
                    let filteredCards = this.cards.filter(card => card.selected);

                    let dashboardWidget = this.getStoredWidgets();

                    dashboardWidget.forEach(widget => {
                        let card = filteredCards.find(card => card.card_id == widget.card_id);

                        if (card) {
                            let previousSort = card.sort;

                            card.sort = widget.sort;

                            let replaceCard = filteredCards.find(card => card.card_id == widget.targetCardId);

                            if (replaceCard) {
                                replaceCard.sort = previousSort;
                            }
                        }
                    });

                    filteredCards = filteredCards.sort((secondCard, firstCard) => secondCard.sort - firstCard.sort);

                    for (let index = 0; index < Math.ceil(filteredCards.length / 3); index++) {
                        filteredCardsChunks.push(filteredCards.slice(index * 3, (index + 1) * 3));
                    }

                    return filteredCardsChunks;
                },

                onRowDrop: function (item) {
                    var existingWidgets = this.getStoredWidgets();
                    let sortIncreasedBy = (item.moved.newIndex - item.moved.oldIndex) - 2;

                    item.moved.element.forEach(movedItem => {
                        let existingWidget = existingWidgets.find(existingWidget => existingWidget.card_id == movedItem.card_id);

                        this.onColumnDrop({
                            moved: {
                                element: movedItem,
                                newIndex: movedItem.sort + sortIncreasedBy,
                                oldIndex: existingWidget?.sort || movedItem.sort,
                            }
                        })
                    });
                },

                onColumnDrop: function (item) {
                    var existingWidgets = this.getStoredWidgets();
                    let changeInIndex = item.moved.newIndex - item.moved.oldIndex;
                    let existingWidget = existingWidgets.find(existingWidget => existingWidget.card_id == item.moved.element.card_id)

                    let sort = (existingWidget?.sort ?? item.moved.element.sort) + changeInIndex;

                    let widget = {
                        sort,
                        card_id       : item.moved.element.card_id,
                        targetCardId  : existingWidgets.find(card => card.sort == sort)?.card_id || this.cards.find(card => card.sort == sort)?.card_id,
                    }

                    if (existingWidgets.find(existingWidget => existingWidget.card_id == widget.targetCardId)) {
                        existingWidgets = existingWidgets.map(existingWidget => {
                            if (existingWidget.card_id == widget.targetCardId) {
                                existingWidget.sort = item.moved.oldIndex + 1;
                            }

                            return existingWidget;
                        });
                    }

                    if (existingWidget) {
                        existingWidgets = existingWidgets.map(existingWidget => existingWidget.card_id == widget.card_id ? widget : existingWidget);
                    } else {
                        existingWidgets.push(widget);
                    }

                    localStorage.setItem('dashboard_widget', JSON.stringify(existingWidgets));

                    this.filterCards();

                    // update all cards between 2 cards
                    if (changeInIndex < 0) {
                        changeInIndex = changeInIndex * -1
                    }

                    if (changeInIndex >= 2) {
                        for(let index = 1; index < changeInIndex; index++) {
                            let sort = widget.sort + index;
                            let cardId = existingWidgets.find(card => card.sort == sort)?.card_id || this.cards.find(card => card.sort == sort)?.card_id

                            EventBus.$emit('applyCardFilter', { cardId });
                        }
                    }

                    EventBus.$emit('applyCardFilter', { cardId : widget.card_id });

                    EventBus.$emit('applyCardFilter', { cardId : widget.targetCardId });
                },

                getStoredWidgets: function () {
                    let existingWidgets = localStorage.getItem('dashboard_widget') || "[]";

                    return JSON.parse(existingWidgets);
                }
            }
        });

        Vue.component('card-component', {
            template: "#card-template",

            props: ['cardId', 'cardType', 'index', 'className'],

            data: function () {
                return {
                    dataLoaded: false,
                    dataCollection: {},
                }
            },

            created: function () {
                if (this.cardType != "custom_card") {
                    this.getCardData(this.cardId, "{{ $startDate }},{{ $endDate }}", "date-range");
                } else {
                    this.dataLoaded = true;
                }

                EventBus.$on('applyCardFilter', updatedData => {
                    if (this.cardId == updatedData.cardId) {
                        this.getCardData(updatedData.cardId, updatedData.filterValue);
                    }
                });

                EventBus.$on('updateDateRange', dates => {
                    this.getCardData(this.cardId, dates.datesRange, "date-range");
                });
            },

            methods: {
                getCardData: function (cardId, filter, filterKey) {
                    this.dataLoaded = false;

                    filterKey = filterKey || "filter";

                    this.$http.get(`{{ route('admin.api.dashboard.card.index') }}?card-id=${cardId}${filter ? `&${filterKey}=${filter}` : ''}`)
                        .then(response => {
                            this.dataCollection = response.data;

                            this.dataLoaded = true;
                        })
                        .catch(error => {
                        });
                },
            }
        });

        Vue.component('card-filter', {
            template: "#card-filter-template",

            props: ['filterType', 'cardId'],

            methods: {
                changeCardFilter: function ({target}) {
                    EventBus.$emit('applyCardFilter', {
                        cardId      : this.cardId,
                        filterValue : target.value,
                    });
                }
            }
        });
    </script>
@endpush
