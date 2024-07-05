@extends('layouts.app')

@section("breadcrumb")
<div class="col-12 col-md-6 order-md-1 order-last">
    <h3>Report Perhari</h3>
    <p class="text-subtitle text-muted">Halaman Report PerHari.</p>
</div>
<div class="col-12 col-md-6 order-md-2 order-first">
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('dashboard') }}">Report Perhari</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                Halaman PerReport
            </li>
        </ol>
    </nav>
</div>
@endsection

@section('content')

@endsection

@push('css')
    <link rel="stylesheet" href="https://unpkg.com/element-ui/lib/theme-chalk/index.css">
@endpush

@push("js")
      @if(config("app.debug"))
        <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    @else
        <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    @endif
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
    <script src="https://unpkg.com/element-ui/lib/index.js"></script>
    <script src="https://unpkg.com/element-ui/lib/umd/locale/en.js"></script>
    <script src="https://unpkg.com/vue-html-to-paper/build/vue-html-to-paper.js"></script>
    <script src="https://unpkg.com/vue-html-to-paper/build/vue-html-to-paper.js"></script>
    <script src="https://unpkg.com/vue-html-to-paper@1.0.2/build/vue-html-to-paper.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.15/lodash.min.js"></script>

    <script>
        var token = "{{ auth()->user()->api_token }}";
        const instance = axios.create({
            baseURL: '{{url("/")}}',
            headers : {
                Authorization : `Bearer ${token}`
            }
        });
        // Alter defaults after instance has been created
        ELEMENT.locale(ELEMENT.lang.en);
        const options = {
            name: '_blank',
            specs: [
                'fullscreen=yes',
                'titlebar=yes',
                'scrollbars=yes'
            ],
            styles: [
                '{{asset('vertical/assets/css/bootstrap.min.css')}}',
                '{{ asset('vertical/assets/css/style.css') }}',
                '{{ asset('css/myPrint.css') }}',
                {{--'{{ asset('plugins/printme-js/bootstrap.min.css') }}',--}}
            ]
        };
        Vue.use(VueHtmlToPaper, options);
        var app = new Vue({
            el: '#vue-app',
            data: {
                pegawai: '',
                title: 'DASHBOARD',
                loading: false,
                data: {
                    month: "{{date('m')}}",
                    year: "{{date('Y')}}",
                    skpd_id: {{ auth()->user()->skpd_id ?? ""}},
                    subunit_id: {{ auth()->user()->subunit_id ?? "" }},
                    pegawai_type: "pns",
                },
                mengetahui: {
                    nama: null,
                    nip: null,
                    jabatan: null
                },
                errors: [],
                report_bulanan: null,
                lists: {
                    skpd: [],
                    subunit: [],
                    tipe_pegawai: [
                        {label: 'PNS', value: 'pns'},
                        {label: 'Kontrak', value: 'kontrak'},
                    ],
                }
            },
            created() {
                this.getSkpd();
                this.getSubunit();
            },
            watch: {
                'pegawai' :{
                    handler: function (val) {
                        setTimeout(()=>{
                            this.getReportBulanan();
                        },1000);
                    },
                    deep: true
                },
                'data.skpd_id': {
                    handler: function (val) {
                        this.loading = false;
                        this.subunit_id = 0;
                        this.getSubunit();
                    },
                    deep: true
                },
                'data.date': {
                    handler: function (val) {
                        this.loading = false;
                    },
                    deep: true
                },
                'data.subunit_id': {
                    handler: function (val) {
                        this.loading = false;
                    },
                    deep: true
                }
            },
            methods: {
                getSkpd() {
                    // this.data.skpd = null;
                    instance.post('/api_web/select/skpd').then(res => {
                        this.lists.skpd = res.data;
                    })
                },
                getSubunit() {
                    // this.data.subunit = null;
                    instance.post('/api_web/select/subunit', {
                        'skpd_id': this.data.skpd_id
                    }).then(res => {
                        this.lists.subunit = res.data;
                    })
                },
                getReportBulanan() {
                    this.report_bulanan = null;
                    this.errors = [];
                    this.loading = true;
                    instance.post('/api_web/ajax/report_dashboard', this.data).then(res => {
                        if (res.data) {
                            this.loading = false;
                            if (res.data.text == 'empty') {
                                this.$notify.error({
                                    title: 'Error',
                                    message: res.data.message
                                });
                            } else {
                                this.report_bulanan = res.data;
                            }
                        }
                    }).catch((e) => {
                        this.loading = false;
                        this.errors = e.response.data.errors;
                    })
                },
                print() {
                    this.$htmlToPaper('printMe');
                }
            }
        })
    </script>
@endpush
