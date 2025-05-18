window.stockDataTable = $('.stock-datatable').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: location.href,
        data: function(data){
            data.filter = {
                date: $('#date').val()
            }

            return data
        }
    },
    aLengthMenu: [
        [25, 50, 100, 200],
        [25, 50, 100, 200]
    ],
    columnDefs: [
        {
        targets: 0, // index kolom No
        width: '1%',
        className: 'dt-nowrap'
        }
    ]
});

$('.btn-filter').click(function(){
    $('#filterModal').modal('hide')
    window.stockDataTable.draw()
})