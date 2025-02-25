/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Main.java to edit this template
 */
package atividade.rodas;
import javax.swing.JOptionPane;
import java.lang.Math;

/**
 *
 * @author Aluno
 */
public class AtividadeRodas {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        
        int atv;
        
        atv = Integer.parseInt(JOptionPane.showInputDialog("Qual atividade você deseja corrigir?\n"
                + "1 - Subtração de 2 números\n"
                + "2 - Multiplição de 2 números\n" 
                + "3 - Divisão de 2 números\n"
                + "4 - Desconto de um produto\n"
                + "5 - Salário com comissão\n"
                + "6 - Área do Trapézio\n"
                + "7 - Contas com multa\n"
                + "8 - Volume do Cilindro\n"
                + "9 - Quadrado da soma de dois números inteiros\n"
                + "10 - Soma do quadrado de 2 números inteiros\n"));
        
        switch(atv) {
            case 1:
                //Atividade 1 - Subtração
                
                 double a,b,c,z;
       
                    a = Double.parseDouble(JOptionPane.showInputDialog("Insira o valor do primeiro número: "));
        
                    b = Double.parseDouble(JOptionPane.showInputDialog("Insira o valor do segundo número: "));
        
                    z = a + b;
        
                    JOptionPane.showInputDialog("O resultado da subtração foi:" + z);
            break;
                case 2:
                     //Atividade 2 - Multiplicação
                    
                    a = Double.parseDouble(JOptionPane.showInputDialog("Insira o valor do primeiro número: "));
                    
                    b = Double.parseDouble(JOptionPane.showInputDialog("Insira o valor do segundo número: "));
                    
                    c = Double.parseDouble(JOptionPane.showInputDialog("Insira o valor do terceiro número: "));
                    
                    z = (a * b) * c;
                    
                    JOptionPane.showInputDialog("O resultado da multiplicação foi:" + z);
                break;
                    case 3:
                        //Atividade 3 - Divisão
                        
                        a = Double.parseDouble(JOptionPane.showInputDialog("Insira o valor do primeiro número: "));
                    
                    do{
                        b = Double.parseDouble(JOptionPane.showInputDialog("Insira o valor do segundo número: "));
                        
                        if (b == 0){
                            JOptionPane.showMessageDialog(null,"O segundo número não pode ser zero!!!");
                        }
                      }while(b == 0);
                    
                              z = a / b;
                              JOptionPane.showInputDialog("O resultado da divisão foi: " + z);
                    break;
                        case 4:
                            //Atividade 4 - Desconto
                            double desc,preco_f,prod;
                           
                            prod = Double.parseDouble(JOptionPane.showInputDialog("Insira o valor do produto: "));
                            
                            desc = prod*0.10;
                            
                            preco_f = prod - desc;
                            
                            JOptionPane.showMessageDialog(null,"O preço a pagar (com os descontos) é de: " + preco_f);
                            
                        break;
                            case 5:
                                //Atividade 5 - Salário
                                double sal, sal_f, vendas, com;
                                
                                sal = Double.parseDouble(JOptionPane.showInputDialog("Insira o salário fixo do funcionário: "));
                                
                                vendas = Double.parseDouble(JOptionPane.showInputDialog("Insira o valor das vendas do funcionário: "));
                                
                                com = vendas*0.04;
                                
                                sal_f = sal+com;
                                
                                JOptionPane.showMessageDialog(null,"O salário do funcionário (com a comissão sobre as vendas) é de: " + sal_f);
                                
                            break;
                                case 6:
                                    //Atividade 6 - Trapézio
                                    double area,base_p,base_g,h;
                                    
                                    base_p = Double.parseDouble(JOptionPane.showInputDialog("Insira a base menor do trapézio: "));
                                    
                                    base_g = Double.parseDouble(JOptionPane.showInputDialog("Insira a base maior do trapézio: "));
                                    
                                    h = Double.parseDouble(JOptionPane.showInputDialog("Insira a altura do trapézio: "));
                                    
                                    area = ((base_g+base_p)*h)/2;
                                    
                                    JOptionPane.showMessageDialog(null,"A área do trapézio é: " + area);
                                    
                                break;
                                    case 7:
                                        //Atividade 7 - Contas
                                        
                                        double conta1,conta2,mult1,mult2;
                                        
                                        sal = Double.parseDouble(JOptionPane.showInputDialog("Insira o valor do seu salário: "));
                                        
                                        conta1 = Double.parseDouble(JOptionPane.showInputDialog("Insira o valor da primeira conta: "));
                                        
                                        conta2 = Double.parseDouble(JOptionPane.showInputDialog("Insira o valor da segunda conta: "));
                                        
                                        mult1 = conta1*0.02;
                                        mult2 = conta2*0.02;
                                        
                                        sal_f = sal - ((conta1 + mult1) + (conta2 + mult2));
                                        
                                       JOptionPane.showMessageDialog(null,"O salário restante é de" + sal_f);   
                                          
                                    break;
                                        case 8:
                                            //Atividade 8 - Volume do cilindro
                                            double volume,raio,altura;
                                    
                                            raio = Double.parseDouble(JOptionPane.showInputDialog("Insira o valor do raio do Cilindro: "));
                                    
                                            altura = Double.parseDouble(JOptionPane.showInputDialog("Insira o valor da altura do cilindro: "));
                                    
                                    
                                            volume = (Math.PI*(raio*raio))*altura;
                                    
                                            JOptionPane.showMessageDialog(null,"O volume do cilindro é: " + volume);
                                        break;
                                            case 9:
                                                //Atividade 9 - Quadrado da soma
                                                
                                                a = Integer.parseInt(JOptionPane.showInputDialog("Insira o valor do primeiro número: "));
                                                
                                                b = Integer.parseInt(JOptionPane.showInputDialog("Insira o valor do segundo número: "));
                                                
                                                z = (a + b) * (a + b);
                                                
                                                
                                                JOptionPane.showMessageDialog(null,"O valor do quadrado da soma dos números apresentados é: " + z); 
                                                
                                            break;
                                                case 10:
                                                    //Atividade 9 - Soma do quadrado
                                                
                                                a = Integer.parseInt(JOptionPane.showInputDialog("Insira o valor do primeiro número: "));
                                                
                                                b = Integer.parseInt(JOptionPane.showInputDialog("Insira o valor do segundo número: "));
                                                
                                                z = (a * a) + (b * b);
                                                
                                                
                                                JOptionPane.showMessageDialog(null,"O valor do quadrado da soma dos números apresentados é: " + z); 
                                                break;
         default:
         // code block
          }
       
       
        
        
       
        
     
        
    }
    
}
