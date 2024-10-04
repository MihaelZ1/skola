*-----------------------------------------------------------
* Title      :      
* Written by :
* Date       :
* Description:
*-----------------------------------------------------------
    ORG    $1000
START:                 
    MOVE #123, d0
    MOVE #65535, d1
    MOVE.l #65536, d2
    MOVE.l #4294967295, d3
    MOVE #$4c3, d4
    MOVE #$ffff,d5
    MOVE.L #$ffffffff, d6
    MOVE.B D4, D0
    
    
    MOVE.L #$01234567, D0
    MOVE.L #$ffffffff, a1
    MOVE.L D0, A1
    
       
    MOVE.L #$008191, D0
    MOVE.L #$00000000,A1
    MOVE.W D0,A1
    
    
    SIMHALT            
    
    
        
    END    START        
*~Font name~Courier New~
*~Font size~10~
*~Tab type~1~
*~Tab size~4~
