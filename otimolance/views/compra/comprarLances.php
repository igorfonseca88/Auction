<div>
        <form>
            <ul>
                <?
                  foreach ($produtos as $key) {
                ?>
                <li>
                    <strong><?=$key->nome?></strong>
                    <img src="<?= base_url() ?>upload/produtos/<?=$key->caminho?>" width="125px" height="80px"/>
                    <strong>R$<?=$key->preco?></strong>
                    <a class="botao" href="<?= base_url() ?>compraController/carrinho/<?= $key->idProduto; ?>">Comprar</a>  
                </li>
                    <?
                  }
                    ?>
            </ul>

        </form>
    </div>
</div>
