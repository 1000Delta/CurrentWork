Vue.component('d-item', {
    data: function() {

        return {
            title: ''
        }
    },
    template: `<div class="d-item">
    <div class="d-title">{{ title }}</div>
</div>`
})

let vm = new Vue({
    el: '#home-page',
    data: {
        searchInput: '123',
        // 搜索后保存的关键字
        searchKey: '',
        // 限定已搜索关键字提示的显示
        isAfterSearch: false,
        dataList: []
    },
    methods: {
        searchSubmit () {
            axios.get('/api/search/'+this.searchInput)
                .then((response) => {
                    // 成功后存入并显示

                    this.searchKey = this.searchInput
                    console.log(response)
                })
                .catch((error) => {
                    
                })
                .then(() => {

                })
        }
    },
    watch: {
        searchKey (newKey, oldKey) {

        if (newKey != '') {

        }
    },
})