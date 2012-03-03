<div>
    <form method="post" action="../pagamento">
            <table width="100%">
                <tr>
                    <td width="40%">
                        <span>Item</span>
                    </td>
                    <td width="10%">
                        <span>Quantidade</span>
                    </td>
                    <td width="20%">
                        <span>Valor Unitário</span>
                    </td>
                    <td width="30%">
                        <span>Subtotal</span>
                    </td>
                </tr>
                
                <? 
                    foreach ($produtos as $key){
                ?>
                <tr>
                <input type="hidden" value="<?=$key->idProduto?>" id="idProdutoHidden" name="idProdutoHidden"/>
                    <td>
                        <img src="<?= base_url() ?>upload/produtos/<?=$key->caminho?>" width="125px" height="80px"/>
                        <span>R$<?=$key->nome?></span>
                    </td>
                    <td>
                         <select id="txtQuantidade" name="txtQuantidade">
                            <option value="0">0</option>
                            <option selected="selected" value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                         </select>
                    </td>
                    <td>
                        <span>R$<?=$key->preco?></span>
                    </td>
                    <td>
                        <span>Muito Barato</span>
                    </td>
                </tr>
                
                <?
                    }
                ?>
            </table>
            <div>
                <input type="submit" value="Continuar" >
            </div>
        </form>
    </div>
</div>
