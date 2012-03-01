<div>
        <form method="post" action="salvarNovaCategoria">
            <ul>
                <?
                    if (count($categorias)) {
                        foreach ($categorias as $key) {
                            
                    echo"<li> <strong>". $key->$nome ."</strong>
                         <img src='".$key->$nome."' alt='' />
                         <strong>". $key->$nome ."</strong>
                         <a href='' >Comprar</a> </li>";
                        }
                    }
                    ?>
            </ul>

        </form>

    </div>
</div>
