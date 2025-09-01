// import java.util.Scanner;
// public class main{
//     public static void main (String[] args){
//         Scanner scan=new Scanner(System.in);

//         System.out.println("entrer un nombre");
//         double X = scan.nextDouble();

//         System.out.println("enter un nouveau nombre");
//         double Y=scan.nextDouble();
        
//         double produit= X * Y;

//         System.out.println("le produit est :"+produit);
//     }
// }

import java.util.Scanner;
public class main {
    public static void main (String[]  args){
        Scanner scann = new Scanner(System.in);

        int valiny1=12;
        String valiny2="poly";
        int note=0;

        System.out.print("CECI EST UN DEVINETTE ");
        System.out.print("firy no isan'ny mpianatry jesosy: ");
        int valinyUtilisateur1=scann.nextInt();
        scann.nextLine();

        if(valinyUtilisateur1==valiny1) {
            note=note+1;
            System.out.println("marina ny valiteninao , ny naoty: "+ note);
        }else{
            note=note-1;
            System.out.println("diso mba mamakia baiboly, ny note: "+ note);
        }

        System.out.print("Iza no anaran’ilay mpianatr’i Jesosy tena nanohitra be taloha fa niova ?");
        String valinyUtilisateur2 = scann.nextLine();
        
        if (valinyUtilisateur2.equals(valiny2))
        {
            note=note+1;
            System.out.println("marina ny valiteninao , ny naoty:"+ note);
        }else{
            note=note-1;
            System.out.println("diso mba mamakia baiboly note:"+ note);
        }

        System.out.print("naoty final: "+note);
    }
}