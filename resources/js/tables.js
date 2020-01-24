function changeUnit(element)
{
    var unit = $("#selectIngredient"+element+" option:selected").attr('data-cc-unit');
    $('#unitIngredient'+element).text(unit);
}