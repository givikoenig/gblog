<?php

namespace App\Admin\Extensions;

use Encore\Admin\Admin;
use Illuminate\Support\Facades\Request;

class DeleteUser
{
    protected $id;

    public function __construct($id, $action=1)
    {
        $this->id = $id;
        $this->action = $action;
    }

    protected function script()
    {

        return <<<SCRIPT

$('.grid-delete-post').on('click', function () {
    
    var id = $(this).data('id');

     swal({
          title: "Удалить пользователя?", 
          text: "Вы уверены, что хотите удалить этого пользователя и все его комментарии и лайки?", 
          type: "warning",
          showCancelButton: true,
          closeOnConfirm: false,
          confirmButtonText: "Да, удалить !",
          confirmButtonColor: "#ec6c62",
          cancelButtonText: "Отмена"
        }, function() {

        $.ajax({
            method: 'post',
            url: 'users/' + id + '/remove',
            data: {
                _token:LA.token,
                id: id,
            },
            success: function (data) {

                swal("Удалено!", "Пользователь успешно удалена!", "success");

                $.pjax.reload('#pjax-container');
                toastr.success('Пользователь удален');
            }
        });

    });

    console.log($(this).data('id'));

});


SCRIPT;
    }

    protected function render()
    {
        Admin::script($this->script());

        return "&nbsp;&nbsp;&nbsp;&nbsp;<a class='fa fa-trash grid-delete-post' data-id='{$this->id}'></a>";
    }

    public function __toString()
    {
        return $this->render();
    }

}

