<?php
function delete()
{
    $sql = "DELETE FROM workspaces WHERE id = $id";

        if ($conn->query($sql) === TRUE) {
            echo "Запись успешно удалена";
        } else {
            echo "Ошибка при удалении записи: " . $conn->error;
        }
}

if(array_key_exists('delete',$_POST)){
    echo " click is working";
   delete();
} else {
    echo " click is not working";
}