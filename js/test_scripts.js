/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function(){
	
    $.getJSON(
        "json.php?id=2",
        function(data){
            $("#id").append(data.id);
            $("#title").append(data.title);
            $("#body").append(data.body);
            $("#notes").append(data.notes);
                $('textarea#body_val').val(data.body);
                $('textarea#notes_val').val(data.notes);
                $('input#input_title').val(data.title);
        }
    );

    $('body').click(function(event) {
        if ($(event.target).is('.ui-icon-circle-plus')) {

            var $book = $(event.target).parent().parent().contents().find("input[name='book']").val();
            var $chapter = $(event.target).parent().parent().contents().find("input[name='chapter']").val();
            var $v_start = $(event.target).parent().parent().contents().find("input[name='v_start']").val();
            var $v_end = $(event.target).parent().parent().contents().find("input[name='v_end']").val();

            alert($book + " :: " + $chapter + " :: " + $v_start + " :: " + $v_end);

            var tblRow = "<tr>"+
                "<td ><input type=\"text\" name=\"book\" /></td>"+
                "<td><input type=\"text\" name=\"chapter\" /></td>"+
                "<td><input type=\"text\" name=\"v_start\" /></td>"+
                "<td><input type=\"text\" name=\"v_end\" /></td>"+
                "<td><span class=\"ui-icon ui-icon-circle-plus\"> </span></td>"
            +"</tr>";

            $(tblRow).appendTo("#verses_table tbody");
        }
    });

    });

    $("#post_body").click(function(){
    var text = $('textarea#body_val').val();
    alert(text);
    $.post("json_post.php?id=2&slot=body", { "body": text});
    });

    $("#post_title").click(function(){
    var text = $('input#input_title').val();
    alert(text);
    $.post("json_post.php?id=2&slot=title", { "title": text});
    });

    $("#post_notes").click(function(){
    var text = $('textarea#notes_val').val();
    alert(text);
    $.post("json_post.php?id=2&slot=notes", { "notes": text});
    });