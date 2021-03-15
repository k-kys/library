(function() {
    var db = {
        loadData: function(filter) {
            return $.grep(this.categories, function(category) {
                return (
                    (!filter.id === undefined || category.id === filter.id) &&
                    (!filter.name || category.name.indexOf(filter.name) > -1)
                );
            });
        },
    };

    window.db = db;

    db.categories = [{
            id: "1",
            name: "Thơ",
        },
        {
            id: "3",
            name: "Truyện",
        },
        {
            id: "5",
            name: "Tiểu thuyết",
        },
        {
            id: "2",
            name: "Văn",
        },
        {
            id: "4",
            name: "Sử thi",
        },
        {
            id: "6",
            name: "Cổ tích",
        },
    ];
})();
