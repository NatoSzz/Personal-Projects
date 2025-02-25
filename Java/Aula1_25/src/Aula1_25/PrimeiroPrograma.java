/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package Aula1_25;

import javax.swing.JOptionPane;

/**
 *
 * @author Aluno
 */
public class PrimeiroPrograma {
    //Para que uma classe se torne
    //"executável", precisamos criar a classe
    //principal
    //Para criá-la automaticamente, escreva
    //psvm e então aperte no botão TAB do teclado
    
    public static void main(String[] args) {
        //Declarar as variáveis para receber
        //valores pelo teclado
        int ano_nasc;
        String nome;
        
        //Então
        
        //Vamos receber esses valores
        //A MAIORIA DAS ENTRADAS NO JAVA
        //SÃO DO TIPO String
        //Então precisamos converter (casting)
        //para um valor numérico
        
        //Para converter String para inteiro
        //utilizamos o comando 
        //Integer.parseInt(variavel String)
        
        ano_nasc = Integer.parseInt(JOptionPane.showInputDialog("Digite o ano de seu nascimento"));
        
         //Vamos receber o nome
        //Como se trata de String, não precisamos converter 
        
        nome = JOptionPane.showInputDialog("Digite o ano de seu nascimento");
        
        //Vamos mostrar a idade da pessoa
        System.out.println("A/o "+ nome +
                " tem " + (2025-ano_nasc) +
                " anos de idade.");
    }
}
