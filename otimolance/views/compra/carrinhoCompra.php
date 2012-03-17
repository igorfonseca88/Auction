<?
$this->load->view('conta/conta');
?>	
<div id="conteudo">
<div>
    <form method="post" action="<?= BASE_URL(); ?>compraController/identificacao">
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
                    <td>
                        <img src="<?= base_url() ?>upload/produtos/<?=$key->caminho?>" width="125px" height="80px"/>
                        <span><?=$key->nome?></span>
                    </td>
                    <td>
                        <select id="txtQuantidade<?=$key->idItemPedido?>" name="txtQuantidade<?=$key->idItemPedido?>" onchange="calcularSubTotal(<?=$key->idItemPedido?>)">
                             <?
                                for($i=0; $i<=5; $i++){
                                    if($key->quantidade == $i){
                             ?>
                                    <option selected="selected" value="<?=$i?>"><?=$i?></option>
                            <?
                                    }
                                    else{
                            ?>
                                    <option value="<?=$i?>"><?=$i?></option>
                            <?
                                    }
                                }
                            ?>
                         </select>
                        <a href="<?= BASE_URL(); ?>compraController/excluirProdutoAction/<?=$key->idItemPedido?>">Excluir</a>
                    </td>
                    <td>
                        <span>R$</span>
                        <span id="txtPreco<?=$key->idItemPedido?>"><?=$key->preco?></span>
                    </td>
                    <td>
                        <span>R$</span>
                        <span id="txtSubTotal<?=$key->idItemPedido?>"><?=$key->subTotal?></span>
                    </td>
                </tr>
                
                <?
                    }
                ?>
            </table>
            <div>
                <a href="<?= BASE_URL(); ?>compraController/comprarLances">Voltar</a>
                <input type="submit" value="Continuar" >
            </div>
        </form>
    </div>
</div>
