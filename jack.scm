(define jack
 (lambda (x y)
  (cond 
  	((null? y) '())
    ((eq? x (car y)) (cons (3) (jack x (cdr y))))
    (else (cons (car y) (jack x (cdr y))))
   )
  )
)