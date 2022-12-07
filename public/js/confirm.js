function deleteHandle(event){
    event.preventDefault();
    if(window.confirm('本当に削除してもいいですか？')){
      document.getElementById('delete-form').submit();
    }else{
      alert('キャンセルしました');
    }
  }

  function deleteHandle_folder(event){
    event.preventDefault();
    if(window.confirm('本当に削除してもいいですか？')){
      document.getElementById('delete-form_folder').submit();
    }else{
      alert('キャンセルしました');
    }
  }
