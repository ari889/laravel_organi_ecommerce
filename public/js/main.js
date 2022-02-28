function select_all(){
    if($('#select_all:checked').length == 1){
        $('.select_data').prop('checked', true);
    }else{
        $('.select_data').prop('checked', false);
    }
    $('.select_data').is(':checked') ? $('.select_data').closest('tr').addClass('bg-selected') : $('.select_data').closest('tr').removeClass('bg-selected');
}

function select_single_item(id){
    var total = $('.select_data').length;
    var total_checked = $('.select_data:checked').length;
    $("#checkbox"+id).is(':checked') ? $("#checkbox"+id).closest('tr').addClass('bg-selected') : $("#checkbox"+id).closest('tr').removeClass('bg-selected');
    (total == total_checked) ? $('#select_all').prop('checked', true) : $('#select_all').prop('checked', false);
}
