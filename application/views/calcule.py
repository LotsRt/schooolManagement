# class mvola:
#     def __init__(self, argent=0):
#         self.argent=argent

#     def depot(self,somme):
#         self.argent+=somme

#     def retrait(self,somme ):
#         self.argent-=somme
        
#     def get_argent(self):
#         return self.argent
        
        
# homme1 = mvola()
# homme2 = mvola()  
# vola1= int(input('vola ampidirinao ry homme 1 :'))
# homme1.depot(vola1)
# print("vola deposer par homme1: ",vola1)

# vola2=int(input('vola ampidirinao ry homme2 :'))
# homme2.depot(vola2)
# print("vola deposer par homme2: ",vola2)

# volaMivoka1=int(input('otrin ny vola alaina ry homme1:'))
# homme1.retrait(volaMivoka1)
# print('naka vola ',volaMivoka1,"ianao ry homme1")
# act1=homme1.get_argent()
# print("noho izany TOTAL VOLA homme1 :",act1)


# volaMivoka2=int(input('otrin ny vola alainao ry homme2:'))
# homme2.retrait(volaMivoka2)
# print('naka vola ',volaMivoka2,"ianao ry homme2")
# act2=homme2.get_argent()
# print(" noho izany TOTAL VOLA homme2 :",act2)   

# print('misaotra anao ny telma')

class gestion:
    def __init__(self,nom,pin,argent=0):
       self.nom=nom
       self.pin=pin
       self.argent=argent
    
    def deposer(self,nom,code,montant):
       print('voulez vous deposer',self.nom,"?")
       for i in range(3):
            code= int(input('entrer le code pin: '))
            if(code==self.pin):
                self.argent+=montant
                print ('vous avez deposer',montant)
                return
            else:
                print('code non reconnue,il vius reste ',2-i)
       print('compte_bloque,vous avez atteint les 3 tentative essayer prochainement')
       
    def retirer(self,code,montant):
       print('faire un retrait?')
       for i in range(3):
            code= int(input('entrer le code pin: '))
            if(code==self.pin):
                self.argent-=montant
            else:
                 print('code non reconnue,il vousreste ',3-i,'tentative')
       print('vous avez atteint la tentative maximun')  
       
    def get_argent(self):
       return self.argent

    def afficher(self,nom):
       print('votre solde actuel',nom,' est de:',self.argent)
       
miora=gestion('miora',123456,5000)    
andry=gestion('andry',0000,10000)   
    
miora.deposer('miora',123456,5000) 
miora.retirer(123456,50000)

miora.get_argent()
andry.get_argent()
miora.afficher('miora')
andry.afficher('andry')